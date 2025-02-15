<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * A string that describes a specific point of interest (POI) category.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/poicategory
 */
enum  PoiCategory: string
{
    case AIRPORT           = 'Airport';

    case AIRPORT_GATE      = 'AirportGate';

    case AIRPORT_TERMINAL  = 'AirportTerminal';

    case AMUSEMENT_PARK    = 'AmusementPark';

    case ANIMAL_SERVICE    = 'AnimalService';

    case AQUARIUM          = 'Aquarium';

    case ATM               = 'ATM';

    case AUTOMOTIVE_REPAIR = 'AutomotiveRepair';

    case BAKERY            = 'Bakery';

    case BANK              = 'Bank';

    case BASEBALL          = 'Baseball';

    case BASKETBALL        = 'Basketball';

    case BEACH             = 'Beach';

    case BEAUTY            = 'Beauty';

    case BOWLING           = 'Bowling';

    case BREWERY           = 'Brewery';

    case CAFE              = 'Cafe';

    case CAMPGROUND        = 'Campground';

    case CAR_RENTAL        = 'CarRental';

    case CASTLE            = 'Castle';

    case CONVENTION_CENTER = 'ConventionCenter';

    case DISTILLERY        = 'Distillery';

    case EV_CHARGER        = 'EVCharger';

    case FAIRGROUND        = 'Fairground';

    case FIRE_STATION      = 'FireStation';

    case FISHING           = 'Fishing';

    case FITNESS_CENTER    = 'FitnessCenter';

    case FOOD_MARKET       = 'FoodMarket';

    case FORTRESS          = 'Fortress';

    case GAS_STATION       = 'GasStation';

    case GO_KART           = 'GoKart';

    case GOLF              = 'Golf';

    case HIKING            = 'Hiking';

    case HOSPITAL          = 'Hospital';

    case HOTEL             = 'Hotel';

    case KAYAKING          = 'Kayaking';

    case LANDMARK          = 'Landmark';

    case LAUNDRY           = 'Laundry';

    case LIBRARY           = 'Library';

    case MAILBOX           = 'Mailbox';

    case MARINA            = 'Marina';

    case MINI_GOLF         = 'MiniGolf';

    case MOVIE_THEATER     = 'MovieTheater';

    case MUSEUM            = 'Museum';

    case MUSIC_VENUE       = 'MusicVenue';

    case NATIONAL_MONUMENT = 'NationalMonument';

    case NATIONAL_PARK     = 'NationalPark';

    case NIGHTLIFE         = 'Nightlife';

    case PARK              = 'Park';

    case PARKING           = 'Parking';

    case PHARMACY          = 'Pharmacy';

    case PLANETARIUM       = 'Planetarium';

    case PLAYGROUND        = 'Playground';

    case POLICE            = 'Police';

    case POSTOFFICE        = 'PostOffice';

    case PUBLIC_TRANSPORT  = 'PublicTransport';

    case RELIGIOUS_SITE    = 'ReligiousSite';

    case RESTAURANT        = 'Restaurant';

    case RESTROOM          = 'Restroom';

    case ROCK_CLIMBING     = 'RockClimbing';

    case RV_PARK           = 'RVPark';

    case SCHOOL            = 'School';

    case SKATE_PARK        = 'SkatePark';

    case SKATING           = 'Skating';

    case SKIING            = 'Skiing';

    case SOCCER            = 'Soccer';

    case SPA               = 'Spa';

    case STADIUM           = 'Stadium';

    case STORE             = 'Store';

    case SURFING           = 'Surfing';

    case SWIMMING          = 'Swimming';

    case TENNIS            = 'Tennis';

    case THEATER           = 'Theater';

    case UNIVERSITY        = 'University';

    case VOLLEYBALL        = 'Volleyball';

    case WINERY            = 'Winery';

    case ZOO               = 'Zoo';
}