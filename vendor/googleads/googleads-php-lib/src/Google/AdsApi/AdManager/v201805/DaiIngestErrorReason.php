<?php

namespace Google\AdsApi\AdManager\v201805;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class DaiIngestErrorReason
{
    const INVALID_INGEST_URL = 'INVALID_INGEST_URL';
    const INVALID_CLOSED_CAPTION_URL = 'INVALID_CLOSED_CAPTION_URL';
    const MISSING_CLOSED_CAPTION_URL = 'MISSING_CLOSED_CAPTION_URL';
    const COULD_NOT_FETCH_HLS = 'COULD_NOT_FETCH_HLS';
    const COULD_NOT_FETCH_SUBTITLES = 'COULD_NOT_FETCH_SUBTITLES';
    const MISSING_SUBTITLE_LANGUAGE = 'MISSING_SUBTITLE_LANGUAGE';
    const COULD_NOT_FETCH_MEDIA = 'COULD_NOT_FETCH_MEDIA';
    const MALFORMED_MEDIA_BYTES = 'MALFORMED_MEDIA_BYTES';
    const CHAPTER_TIME_OUT_OF_BOUNDS = 'CHAPTER_TIME_OUT_OF_BOUNDS';
    const INTERNAL_ERROR = 'INTERNAL_ERROR';
    const CONTENT_HAS_CHAPTER_TIMES_BUT_NO_MIDROLL_SETTINGS = 'CONTENT_HAS_CHAPTER_TIMES_BUT_NO_MIDROLL_SETTINGS';
    const MALFORMED_MEDIA_PLAYLIST = 'MALFORMED_MEDIA_PLAYLIST';
    const MALFORMED_SUBTITLES = 'MALFORMED_SUBTITLES';
    const PLAYLIST_ITEM_URL_DOES_NOT_MATCH_INGEST_COMMON_PATH = 'PLAYLIST_ITEM_URL_DOES_NOT_MATCH_INGEST_COMMON_PATH';
    const COULD_NOT_UPLOAD_SPLIT_MEDIA_AUTHENTICATION_FAILED = 'COULD_NOT_UPLOAD_SPLIT_MEDIA_AUTHENTICATION_FAILED';
    const COULD_NOT_UPLOAD_SPLIT_MEDIA_CONNECTION_FAILED = 'COULD_NOT_UPLOAD_SPLIT_MEDIA_CONNECTION_FAILED';
    const COULD_NOT_UPLOAD_SPLIT_MEDIA_WRITE_FAILED = 'COULD_NOT_UPLOAD_SPLIT_MEDIA_WRITE_FAILED';
    const PLAYLISTS_HAVE_DIFFERENT_NUMBER_OF_DISCONTINUITIES = 'PLAYLISTS_HAVE_DIFFERENT_NUMBER_OF_DISCONTINUITIES';
    const PLAYIST_HAS_NO_STARTING_PTS_VALUE = 'PLAYIST_HAS_NO_STARTING_PTS_VALUE';
    const PLAYLIST_DISCONTINUITY_PTS_VALUES_DIFFER_TOO_MUCH = 'PLAYLIST_DISCONTINUITY_PTS_VALUES_DIFFER_TOO_MUCH';
    const SEGMENT_HAS_NO_PTS = 'SEGMENT_HAS_NO_PTS';
    const SUBTITLE_LANGUAGE_DOES_NOT_MATCH_LANGUAGE_IN_FEED = 'SUBTITLE_LANGUAGE_DOES_NOT_MATCH_LANGUAGE_IN_FEED';
    const CANNOT_DETERMINE_CORRECT_SUBTITLES_FOR_LANGUAGE = 'CANNOT_DETERMINE_CORRECT_SUBTITLES_FOR_LANGUAGE';
    const NO_CDN_CONFIGURATION_FOUND = 'NO_CDN_CONFIGURATION_FOUND';
    const CONTENT_HAS_MIDROLLS_BUT_NO_SPLIT_CONTENT_CONFIG = 'CONTENT_HAS_MIDROLLS_BUT_NO_SPLIT_CONTENT_CONFIG';
    const CONTENT_HAS_MIDROLLS_BUT_SOURCE_HAS_MIDROLLS_DISABLED = 'CONTENT_HAS_MIDROLLS_BUT_SOURCE_HAS_MIDROLLS_DISABLED';
    const ADTS_PARSE_ERROR = 'ADTS_PARSE_ERROR';
    const AAC_SPLIT_ERROR = 'AAC_SPLIT_ERROR';
    const AAC_PARSE_ERROR = 'AAC_PARSE_ERROR';
    const TS_PARSE_ERROR = 'TS_PARSE_ERROR';
    const TS_SPLIT_ERROR = 'TS_SPLIT_ERROR';
    const UNSUPPORTED_CONTAINER_FORMAT = 'UNSUPPORTED_CONTAINER_FORMAT';
    const MULTIPLE_ELEMENTARY_STREAMS_OF_SAME_MEDIA_TYPE_IN_TS = 'MULTIPLE_ELEMENTARY_STREAMS_OF_SAME_MEDIA_TYPE_IN_TS';
    const UNSUPPORTED_TS_MEDIA_FORMAT = 'UNSUPPORTED_TS_MEDIA_FORMAT';
    const NO_IFRAMES_NEAR_CUE_POINT = 'NO_IFRAMES_NEAR_CUE_POINT';
    const AC3_SPLIT_ERROR = 'AC3_SPLIT_ERROR';
    const AC3_PARSE_ERROR = 'AC3_PARSE_ERROR';
    const EAC3_SPLIT_ERROR = 'EAC3_SPLIT_ERROR';
    const INVALID_ENCRYPTION_KEY = 'INVALID_ENCRYPTION_KEY';
    const EAC3_PARSE_ERROR = 'EAC3_PARSE_ERROR';
    const UNKNOWN = 'UNKNOWN';


}
