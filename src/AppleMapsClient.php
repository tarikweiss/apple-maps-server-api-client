<?php

namespace AppleMapsServerApiClient;

use AppleMapsServerApiClient\Auth\TokenSource;
use AppleMapsServerApiClient\Dto\Common\DirectionsResponse;
use AppleMapsServerApiClient\Dto\Common\ErrorResponse;
use AppleMapsServerApiClient\Dto\Common\EtaResponse;
use AppleMapsServerApiClient\Dto\Common\Lang;
use AppleMapsServerApiClient\Dto\Common\Place;
use AppleMapsServerApiClient\Dto\Common\PlaceResults;
use AppleMapsServerApiClient\Dto\Common\SearchAutocompleteResponse;
use AppleMapsServerApiClient\Dto\Common\SearchLocation;
use AppleMapsServerApiClient\Dto\Common\SearchResponse;
use AppleMapsServerApiClient\Dto\Common\TokenResponse;
use AppleMapsServerApiClient\Dto\Searching\AlternateIdsResponse;
use AppleMapsServerApiClient\Dto\Searching\PlacesResponse;
use AppleMapsServerApiClient\Exception\Client\HttpResponseException;
use AppleMapsServerApiClient\Query\DirectionsQuery;
use AppleMapsServerApiClient\Query\EtasQuery;
use AppleMapsServerApiClient\Query\GeocodeQuery;
use AppleMapsServerApiClient\Query\PlaceAlternateIdsQuery;
use AppleMapsServerApiClient\Query\PlaceByIdQuery;
use AppleMapsServerApiClient\Query\PlaceQuery;
use AppleMapsServerApiClient\Query\ReverseGeocodeQuery;
use AppleMapsServerApiClient\Query\SearchAutocompleteQuery;
use AppleMapsServerApiClient\Query\SearchQuery;
use AppleMapsServerApiClient\Util\MappingUtil;
use AppleMapsServerApiClient\Util\ValidationUtil;
use Http\Discovery\Psr17Factory;
use Http\Discovery\Psr18Client;
use JsonMapper\Exception\BuilderException;
use JsonMapper\JsonMapperBuilder;
use JsonMapper\JsonMapperInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * The main class for interacting with the Apple Maps Server API.
 * For further information, you may refer to the Apple developer documentation.
 *
 * @see https://developer.apple.com/documentation/applemapsserverapi
 */
class AppleMapsClient
{
    protected const API_BASE_URL = 'https://maps-api.apple.com';

    protected TokenSource             $tokenInformation;

    protected ?TokenResponse          $currentToken = null;

    protected ClientInterface         $client;

    protected RequestFactoryInterface $requestFactory;

    protected JsonMapperInterface     $jsonMapper;


    public function __construct(TokenSource $tokenInformation, ?ClientInterface $client = null, ?RequestFactoryInterface $requestFactory = null)
    {
        $this->tokenInformation = $tokenInformation;

        if (null === $client) {
            $client = new Psr18Client();
        }

        if (null === $requestFactory) {
            $requestFactory = new Psr17Factory();
        }

        $this->client         = $client;
        $this->requestFactory = $requestFactory;

        $this->configureJsonMapper();
    }


    /**
     * <h1>Geocode an address</h1>
     * Returns the latitude and longitude of the address you specify.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-geocode
     */
    public function geocode(GeocodeQuery $geocodeQuery): PlaceResults
    {
        $queryData = ['q' => $geocodeQuery->q];

        if (true === ValidationUtil::checkArrayIsNotEmpty($geocodeQuery->limitToCountries)) {
            $queryData['limitToCountries'] = implode(',', $geocodeQuery->limitToCountries);
        }

        if (null !== $geocodeQuery->lang) {
            $queryData['lang'] = $geocodeQuery->lang->lang;
        }

        if (null !== $geocodeQuery->searchLocation) {
            $queryData['searchLocation'] = $geocodeQuery->searchLocation->searchLocation;
        }

        if (null !== $geocodeQuery->searchRegion) {
            $queryData['searchRegion'] = $geocodeQuery->searchRegion->searchRegion;
        }

        if (null !== $geocodeQuery->userLocation) {
            $queryData['userLocation'] = $geocodeQuery->userLocation->userLocation;
        }

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/geocode',
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                PlaceResults::class
            )
        ;
    }


    /**
     * <h1>Reverse geocode a location</h1>
     * Returns an array of addresses present at the coordinates you provide.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-reversegeocode
     */
    public function reverseGeocode(ReverseGeocodeQuery $reverseGeocodeQuery): PlaceResults
    {
        $queryData = ['loc' => $reverseGeocodeQuery->loc->searchLocation];

        if (null !== $reverseGeocodeQuery->lang) {
            $queryData['lang'] = $reverseGeocodeQuery->lang->lang;
        }

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/reverseGeocode',
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                PlaceResults::class
            )
        ;
    }


    /**
     * <h1>Search for places that match specific criteria</h1>
     * Find places by name or by specific search criteria.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-search
     */
    public function search(SearchQuery $searchQuery): SearchResponse
    {
        $queryData = ['q' => $searchQuery->q];

        if (null !== $searchQuery->excludePoiCategories) {
            $queryData['excludePoiCategories'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->excludePoiCategories);
        }

        if (null !== $searchQuery->includePoiCategories) {
            $queryData['includePoiCategories'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->includePoiCategories);
        }

        if (null !== $searchQuery->limitToCountries) {
            $queryData['limitToCountries'] = implode(',', $searchQuery->limitToCountries);
        }

        if (null !== $searchQuery->resultTypeFilter) {
            $queryData['resultTypeFilter'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->resultTypeFilter);
        }

        if (null !== $searchQuery->lang) {
            $queryData['lang'] = $searchQuery->lang->lang;
        }

        if (null !== $searchQuery->searchLocation) {
            $queryData['searchLocation'] = $searchQuery->searchLocation->searchLocation;
        }

        if (null !== $searchQuery->searchRegion) {
            $queryData['searchRegion'] = $searchQuery->searchRegion->searchRegion;
        }

        if (null !== $searchQuery->userLocation) {
            $queryData['userLocation'] = $searchQuery->userLocation->userLocation;
        }

        if (null !== $searchQuery->searchRegionPriority) {
            $queryData['searchRegionPriority'] = $searchQuery->searchRegionPriority->value;
        }

        if (null !== $searchQuery->enablePagination) {
            $queryData['enablePagination'] = $searchQuery->enablePagination;
        }

        if (null !== $searchQuery->pageToken) {
            $queryData['pageToken'] = $searchQuery->pageToken;
        }

        if (null !== $searchQuery->includeAddressCategories) {
            $queryData['includeAddressCategories'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->includeAddressCategories);
        }

        if (null !== $searchQuery->excludeAddressCategories) {
            $queryData['excludeAddressCategories'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->excludeAddressCategories);
        }

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/search',
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                SearchResponse::class
            )
        ;
    }


    /**
     * <h1>Search for places that meet specific criteria to autocomplete a place search</h1>
     * Find results that you can use to autocomplete searches.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-searchautocomplete
     */
    public function searchAutocomplete(SearchAutocompleteQuery $searchQuery): SearchAutocompleteResponse
    {
        $queryData = ['q' => $searchQuery->q];

        if (null !== $searchQuery->excludePoiCategories) {
            $queryData['excludePoiCategories'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->excludePoiCategories);
        }

        if (null !== $searchQuery->includePoiCategories) {
            $queryData['includePoiCategories'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->includePoiCategories);
        }

        if (null !== $searchQuery->lang) {
            $queryData['lang'] = $searchQuery->lang->lang;
        }

        if (null !== $searchQuery->limitToCountries) {
            $queryData['limitToCountries'] = implode(',', $searchQuery->limitToCountries);
        }

        if (null !== $searchQuery->resultTypeFilter) {
            $queryData['resultTypeFilter'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->resultTypeFilter);
        }

        if (null !== $searchQuery->searchLocation) {
            $queryData['searchLocation'] = $searchQuery->searchLocation->searchLocation;
        }

        if (null !== $searchQuery->searchRegion) {
            $queryData['searchRegion'] = $searchQuery->searchRegion->searchRegion;
        }

        if (null !== $searchQuery->userLocation) {
            $queryData['userLocation'] = $searchQuery->userLocation->userLocation;
        }

        if (null !== $searchQuery->searchRegionPriority) {
            $queryData['searchRegionPriority'] = $searchQuery->searchRegionPriority->value;
        }

        if (null !== $searchQuery->includeAddressCategories) {
            $queryData['includeAddressCategories'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->includeAddressCategories);
        }

        if (null !== $searchQuery->excludeAddressCategories) {
            $queryData['excludeAddressCategories'] = MappingUtil::mapEnumArrayToCommaSeparatedList($searchQuery->excludeAddressCategories);
        }

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/searchAutocomplete',
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                SearchAutocompleteResponse::class
            )
        ;
    }


    /**
     * <h1>Search for places using mulitple identifiers</h1>
     * Obtain a set of Place objects for a given set of Place IDs.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-place
     */
    public function place(PlaceQuery $placeQuery): PlacesResponse
    {
        $queryData = ['ids' => implode(',', $placeQuery->ids)];

        if (null !== $placeQuery->lang) {
            $queryData['lang'] = $placeQuery->lang->lang;
        }

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/place',
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                PlacesResponse::class
            )
        ;
    }


    /**
     * <h1>Search for a place using an identifier</h1>
     * Obtain a set of Place objects for a given set of Place IDs.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-place
     */
    public function placeById(PlaceByIdQuery $placeIdQuery): Place
    {
        $queryData = [];

        if (null !== $placeIdQuery->lang) {
            $queryData['lang'] = $placeIdQuery->lang->lang;
        }

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/place/' . $placeIdQuery->id,
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                Place::class
            )
        ;
    }


    /**
     * <h1>Obtain a list of alternate place identifiers</h1>
     * Get a list of alternate Place IDs given one or more Place IDs.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-place-alternateids
     */
    public function placeAlternateIds(PlaceAlternateIdsQuery $placeAlternateIdsQuery): AlternateIdsResponse
    {
        $queryData = ['ids' => implode(',', $placeAlternateIdsQuery->ids)];

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/place/alternateIds',
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                AlternateIdsResponse::class
            )
        ;
    }


    /**
     * <h1>Search for directions and estimated travel time between locations</h1>
     * Find directions by specific criteria.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-directions
     */
    public function directions(DirectionsQuery $directionsQuery): DirectionsResponse
    {
        $queryData = [
            'origin'      => $directionsQuery->origin,
            'destination' => $directionsQuery->destination,
        ];

        if (null !== $directionsQuery->arrivalDate) {
            $queryData['arrivalDate'] = MappingUtil::mapDateTimeToISO8601($directionsQuery->arrivalDate);
        }

        if (null !== $directionsQuery->avoid) {
            $queryData['avoid'] = MappingUtil::mapEnumArrayToCommaSeparatedList($directionsQuery->avoid);
        }

        if (null !== $directionsQuery->departureDate) {
            $queryData['departureDate'] = MappingUtil::mapDateTimeToISO8601($directionsQuery->departureDate);
        }

        if (null !== $directionsQuery->lang) {
            $queryData['lang'] = $directionsQuery->lang->lang;
        }

        if (null !== $directionsQuery->requestsAlternateRoutes) {
            $queryData['requestsAlternateRoutes'] = $directionsQuery->requestsAlternateRoutes ? 'true' : 'false';
        }

        if (null !== $directionsQuery->searchLocation) {
            $queryData['searchLocation'] = $directionsQuery->searchLocation->searchLocation;
        }

        if (null !== $directionsQuery->searchRegion) {
            $queryData['searchRegion'] = $directionsQuery->searchRegion->searchRegion;
        }

        if (null !== $directionsQuery->transportType) {
            $queryData['transportType'] = $directionsQuery->transportType->value;
        }

        if (null !== $directionsQuery->userLocation) {
            $queryData['userLocation'] = $directionsQuery->userLocation->userLocation;
        }

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/place/directions',
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                DirectionsResponse::class
            )
        ;
    }


    /**
     * <h1>Determine estimated arrival times and distances to one or more destinations</h1>
     * Returns the estimated time of arrival (ETA) and distance between starting and ending locations.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-etas
     */
    public function etas(EtasQuery $etasQuery): EtaResponse
    {
        $queryData = [
            'origin'      => $etasQuery->origin,
            'destination' => MappingUtil::mapSearchLocationArrayToPipeSeparatedList($etasQuery->destination),
        ];

        if (null !== $etasQuery->transportType) {
            $queryData['transportType'] = $etasQuery->transportType->value;
        }

        if (null !== $etasQuery->departureDate) {
            $queryData['departureDate'] = MappingUtil::mapDateTimeToISO8601($etasQuery->departureDate);
        }

        if (null !== $etasQuery->arrivalDate) {
            $queryData['arrivalDate'] = MappingUtil::mapDateTimeToISO8601($etasQuery->arrivalDate);
        }

        $response = $this->requestAuthenticated(
            'GET',
            self::API_BASE_URL . '/v1/place/etas',
            $queryData
        );

        return $this
            ->jsonMapper
            ->mapToClassFromString(
                $response
                    ->getBody()
                    ->getContents(),
                EtaResponse::class
            )
        ;
    }


    /**
     * <h1>Generate a Maps token</h1>
     * Returns a JWT maps access token that you use to call the service API.
     *
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     * @since Apple Maps Server API 1.2+
     * @see   https://developer.apple.com/documentation/applemapsserverapi/-v1-token
     */
    protected function token(TokenSource $tokenInformation): TokenResponse
    {
        $authToken = $tokenInformation->toJwt();

        $request = $this->createRequest('GET', self::API_BASE_URL . '/v1/token');
        $request = $request->withHeader('Authorization', 'Bearer ' . $authToken);

        $response = $this
            ->client
            ->sendRequest($request)
        ;

        if (200 === $response->getStatusCode()) {
            $tokenResponse = new TokenResponse();
            $this
                ->jsonMapper
                ->mapObjectFromString(
                    $response
                        ->getBody()
                        ->getContents(),
                    $tokenResponse
                )
            ;

            return $tokenResponse;
        }

        $this->handleError($response, 'Error during request for token.');
    }


    /**
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     */
    protected function requestAuthenticated(
        string $method,
        string $url,
        array  $queryData,
        bool   $isRetry = false
    ): ResponseInterface
    {
        $request = $this->createRequest($method, $url, $queryData);
        $request = $request->withHeader('Authorization', 'Bearer ' . $this->getOrRenewAccessToken($isRetry));

        $response = $this
            ->client
            ->sendRequest($request)
        ;

        if ($response->getStatusCode() >= 200 && $response->getStatusCode() <= 299) {
            return $response;
        }

        if (false === $isRetry && 401 === $response->getStatusCode()) {
            return $this->requestAuthenticated($method, $url, $queryData, true);
        }

        $this->handleError($response, 'An error occurred during the request.');
    }


    /**
     * @throws ClientExceptionInterface
     * @throws HttpResponseException
     */
    protected function getOrRenewAccessToken(bool $forceRefresh = false): string
    {
        if (false === $forceRefresh && null !== $this->currentToken) {
            return $this
                ->currentToken
                ->accessToken;
        }

        $this->currentToken = $this->token($this->tokenInformation);

        return $this->getOrRenewAccessToken();
    }


    /**
     * @throws BuilderException
     */
    protected function configureJsonMapper(): void
    {
        $this->jsonMapper = JsonMapperBuilder::new()
                                             ->withDocBlockAnnotationsMiddleware()
                                             ->withTypedPropertiesMiddleware()
                                             ->withNamespaceResolverMiddleware()
                                             ->build()
        ;
    }


    protected function createRequest(string $method, string $url, ?array $queryData = null): RequestInterface
    {
        $fullUrl = $url;
        if (true === is_array($queryData) && ValidationUtil::checkArrayIsNotEmpty($queryData)) {
            $queryData = MappingUtil::clearEmptyStringValues($queryData);
            $fullUrl   .= '?' . http_build_query($queryData);
        }

        return $this
            ->requestFactory
            ->createRequest($method, $fullUrl)
        ;
    }


    /**
     * @throws HttpResponseException
     */
    protected function handleError(ResponseInterface $response, string $message): never
    {
        $bodyContents = $response
            ->getBody()
            ->getContents()
        ;

        try {
            $errorResponse = $this
                ->jsonMapper
                ->mapToClassFromString(
                    $bodyContents,
                    ErrorResponse::class
                )
            ;
        } catch (Throwable) {
            // If server is returning complete nonsense then at least try to keep as message.
            $errorResponse          = new ErrorResponse();
            $errorResponse->message = $bodyContents;
        }

        throw new HttpResponseException(
            $errorResponse,
            $message,
            $response->getStatusCode()
        );
    }
}