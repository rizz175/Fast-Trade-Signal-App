<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/style.css" />
    <title>Home page</title>
</head>
<body>
    <header class="sticky-filters">
        <form id="filtersBar" class="l-filtersBar filtersBar">
            <div class="l-container l-filtersBar-container">
                <div class="filtersBar-filter filtersBar-location">
                    <div id="filters-location" class="filters-location">
                        <div class="filters-location">
                            <input type="text" class="input input--full autocomplete-text" title="Enter a search location" placeholder="Enter a search location" tabindex="0" autocapitalize="off" autocomplete="on" autocorrect="off" value="New York">
                            <div class="autocomplete-clear-button" role="button" tabindex="0" aria-label="Remove search location">✕</div>
                        </div>
                    </div>
                    <div id="filters-suggestions" class="filters-suggestions">
                        <!-- <div class="autocomplete-suggestionsContext">
                            <ol class="autocomplete-suggestions">
                                <li class="autocomplete-suggestion autocomplete-suggestion--recent"><span class="autocomplete-suggestionLink"><span class="autocomplete-suggestion-highlighted">New York</span><span class="autocomplete-suggestion-normal">, North Shields, Northumberland</span></span>
                                </li>
                                <li class="autocomplete-suggestion autocomplete-suggestion--selected"><span class="autocomplete-suggestionLink"><span class="autocomplete-suggestion-highlighted">New York</span><span class="autocomplete-suggestion-normal">, Lincoln, Lincolnshire</span></span>
                                </li>
                            </ol>
                        </div> -->
                    </div>
                    <div id="radiusFilterBar" class="filtersBar-radius">
                        <div class="select-wrapper filters-selectWrapper">
                            <div class="select-value">
                                <span>+ 20 miles</span>
                                <div class="no-svg-chevron select-chevron">
                                    <svg viewBox="0 0 7.6 4.1">
                                        <path d="M4 4L7.5.5c.2-.2.1-.5-.2-.5h-7C0 0-.1.3.1.5L3.6 4c.1.1.3.1.4 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <select class="select" name="radius" title="Search radius">
                                <option value="0.0" selected="">+ 0 miles</option>
                                <option value="0.25">+ 1/4 mile</option>
                                <option value="0.5">+ 1/2 mile</option>
                                <option value="1.0">+ 1 mile</option>
                                <option value="3.0">+ 3 miles</option>
                                <option value="5.0">+ 5 miles</option>
                                <option value="10.0">+ 10 miles</option>
                                <option value="15.0">+ 15 miles</option>
                                <option value="20.0">+ 20 miles</option>
                                <option value="30.0">+ 30 miles</option>
                                <option value="40.0">+ 40 miles</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="priceFilterBar" class="filtersBar-filter filtersBar-price">
                    <label class="filters-label">Price:</label>
                    <div class="filters-dropdown filters-dropdown--double">
                        <div class="select-wrapper filters-selectWrapper">
                            <span class="select-value">
                                <span>Min Price</span>
                                <div class="no-svg-chevron select-chevron">
                                    <svg viewBox="0 0 7.6 4.1">
                                        <path d="M4 4L7.5.5c.2-.2.1-.5-.2-.5h-7C0 0-.1.3.1.5L3.6 4c.1.1.3.1.4 0z"></path>
                                    </svg>
                                </div>
                            </span>
                            <select name="minPrice" class="select" title="Min Price">
                                <option value="">Min Price</option>
                                <option value="100">£100 PCM</option>
                                <option value="150">£150 PCM</option>
                                <option value="200">£200 PCM</option>
                                <option value="250">£250 PCM</option>
                                <option value="300">£300 PCM</option>
                                <option value="350">£350 PCM</option>
                                <option value="400">£400 PCM</option>
                                <option value="450">£450 PCM</option>
                                <option value="500">£500 PCM</option>
                                <option value="600">£600 PCM</option>
                                <option value="700">£700 PCM</option>
                                <option value="800">£800 PCM</option>
                                <option value="900">£900 PCM</option>
                                <option value="1000">£1,000 PCM</option>
                                <option value="1100">£1,100 PCM</option>
                                <option value="1200">£1,200 PCM</option>
                                <option value="1250">£1,250 PCM</option>
                                <option value="1300">£1,300 PCM</option>
                                <option value="1400">£1,400 PCM</option>
                                <option value="1500">£1,500 PCM</option>
                                <option value="1750">£1,750 PCM</option>
                                <option value="2000">£2,000 PCM</option>
                                <option value="2250">£2,250 PCM</option>
                                <option value="2500">£2,500 PCM</option>
                                <option value="2750">£2,750 PCM</option>
                                <option value="3000">£3,000 PCM</option>
                                <option value="3500">£3,500 PCM</option>
                                <option value="4000">£4,000 PCM</option>
                                <option value="4500">£4,500 PCM</option>
                                <option value="5000">£5,000 PCM</option>
                                <option value="5500">£5,500 PCM</option>
                                <option value="6000">£6,000 PCM</option>
                                <option value="6500">£6,500 PCM</option>
                                <option value="7000">£7,000 PCM</option>
                                <option value="8000">£8,000 PCM</option>
                                <option value="9000">£9,000 PCM</option>
                                <option value="10000">£10,000 PCM</option>
                                <option value="12500">£12,500 PCM</option>
                                <option value="15000">£15,000 PCM</option>
                                <option value="17500">£17,500 PCM</option>
                                <option value="20000">£20,000 PCM</option>
                                <option value="25000">£25,000 PCM</option>
                                <option value="30000">£30,000 PCM</option>
                                <option value="35000">£35,000 PCM</option>
                                <option value="40000">£40,000 PCM</option>
                                <option value="">Min Price</option>
                            </select>
                        </div>
                        <div class="filters-text">to</div>
                        <div class="select-wrapper filters-selectWrapper">
                            <span class="select-value">
                                <span>Max Price</span>
                                <div class="no-svg-chevron select-chevron">
                                    <svg viewBox="0 0 7.6 4.1">
                                        <path d="M4 4L7.5.5c.2-.2.1-.5-.2-.5h-7C0 0-.1.3.1.5L3.6 4c.1.1.3.1.4 0z"></path>
                                    </svg>
                                </div>
                            </span>
                            <select name="maxPrice" class="select" title="Max Price">
                                <option value="">Max Price</option>
                                <option value="100">£100 PCM</option>
                                <option value="150">£150 PCM</option>
                                <option value="200">£200 PCM</option>
                                <option value="250">£250 PCM</option>
                                <option value="300">£300 PCM</option>
                                <option value="350">£350 PCM</option>
                                <option value="400">£400 PCM</option>
                                <option value="450">£450 PCM</option>
                                <option value="500">£500 PCM</option>
                                <option value="600">£600 PCM</option>
                                <option value="700">£700 PCM</option>
                                <option value="800">£800 PCM</option>
                                <option value="900">£900 PCM</option>
                                <option value="1000">£1,000 PCM</option>
                                <option value="1100">£1,100 PCM</option>
                                <option value="1200">£1,200 PCM</option>
                                <option value="1250">£1,250 PCM</option>
                                <option value="1300">£1,300 PCM</option>
                                <option value="1400">£1,400 PCM</option>
                                <option value="1500">£1,500 PCM</option>
                                <option value="1750">£1,750 PCM</option>
                                <option value="2000">£2,000 PCM</option>
                                <option value="2250">£2,250 PCM</option>
                                <option value="2500">£2,500 PCM</option>
                                <option value="2750">£2,750 PCM</option>
                                <option value="3000">£3,000 PCM</option>
                                <option value="3500">£3,500 PCM</option>
                                <option value="4000">£4,000 PCM</option>
                                <option value="4500">£4,500 PCM</option>
                                <option value="5000">£5,000 PCM</option>
                                <option value="5500">£5,500 PCM</option>
                                <option value="6000">£6,000 PCM</option>
                                <option value="6500">£6,500 PCM</option>
                                <option value="7000">£7,000 PCM</option>
                                <option value="8000">£8,000 PCM</option>
                                <option value="9000">£9,000 PCM</option>
                                <option value="10000">£10,000 PCM</option>
                                <option value="12500">£12,500 PCM</option>
                                <option value="15000">£15,000 PCM</option>
                                <option value="17500">£17,500 PCM</option>
                                <option value="20000">£20,000 PCM</option>
                                <option value="25000">£25,000 PCM</option>
                                <option value="30000">£30,000 PCM</option>
                                <option value="35000">£35,000 PCM</option>
                                <option value="40000">£40,000 PCM</option>
                                <option value="">Max Price</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="bedroomFilterBar" class="filtersBar-filter filtersBar-bedrooms">
                    <label class="filters-label">Bedrooms:</label>
                    <div class="filters-dropdown filters-dropdown--double">
                        <div class="select-wrapper filters-selectWrapper">
                            <span class="select-value">
                                <span>4 Bed</span>
                                <div class="no-svg-chevron select-chevron">
                                    <svg viewBox="0 0 7.6 4.1">
                                        <path d="M4 4L7.5.5c.2-.2.1-.5-.2-.5h-7C0 0-.1.3.1.5L3.6 4c.1.1.3.1.4 0z"></path>
                                    </svg>
                                </div>
                            </span>
                            <select name="minBedrooms" class="select" title="Min Beds">
                                <option value="">Min Beds</option>
                                <option value="0">Studio</option>
                                <option value="1">1 Bed</option>
                                <option value="2">2 Bed</option>
                                <option value="3">3 Bed</option>
                                <option value="4">4 Bed</option>
                                <option value="5">5 Bed</option>
                                <option value="6">6 Bed</option>
                                <option value="7">7 Bed</option>
                                <option value="8">8 Bed</option>
                                <option value="9">9 Bed</option>
                                <option value="10">10 Bed</option>
                                <option value="">Min Beds</option>
                            </select>
                        </div>
                        <div class="filters-text">to</div>
                        <div class="select-wrapper filters-selectWrapper">
                            <span class="select-value">
                                <span>Max Beds</span>
                                <div class="no-svg-chevron select-chevron">
                                    <svg viewBox="0 0 7.6 4.1">
                                        <path d="M4 4L7.5.5c.2-.2.1-.5-.2-.5h-7C0 0-.1.3.1.5L3.6 4c.1.1.3.1.4 0z"></path>
                                    </svg>
                                </div>
                            </span>
                            <select name="maxBedrooms" class="select" title="Max Beds">
                                <option value="">Max Beds</option>
                                <option value="0">Studio</option>
                                <option value="1">1 Bed</option>
                                <option value="2">2 Bed</option>
                                <option value="3">3 Bed</option>
                                <option value="4">4 Bed</option>
                                <option value="5">5 Bed</option>
                                <option value="6">6 Bed</option>
                                <option value="7">7 Bed</option>
                                <option value="8">8 Bed</option>
                                <option value="9">9 Bed</option>
                                <option value="10">10 Bed</option>
                                <option value="">Max Beds</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="filtersBar-filter filtersBar-propertyType" role="button" tabindex="0">
                    <div>
                        <span>Property Type (1)</span>
                        <span></span>
                        <div class="no-svg-chevron select-chevron">
                            <svg viewBox="0 0 7.6 4.1">
                                <path d="M4 4L7.5.5c.2-.2.1-.5-.2-.5h-7C0 0-.1.3.1.5L3.6 4c.1.1.3.1.4 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="filtersBar-filter filtersBar-more" role="button" tabindex="0">
                    <div class="filtersBar-moreText">
                        <span>Filters</span>
                        <span></span>
                        <div class="no-svg-chevron select-chevron">
                            <svg viewBox="0 0 7.6 4.1">
                                <path d="M4 4L7.5.5c.2-.2.1-.5-.2-.5h-7C0 0-.1.3.1.5L3.6 4c.1.1.3.1.4 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="locationIdentifier" value="REGION^87220">
            </div>
        </form>
        <div class="filtersTray">
            <div class="filtersTray-content">
                <div class="filtersTray-filter filtersTray-dropdown filtersTray-addedToSiteAndStatus">
                    <div class="l-container">
                        <div id="addedToSiteFilter" class="addedToSiteAndLetType">
                            <label class="filters-label">Added to Site:</label>
                            <div class="addedToSiteAndLetType-flexSpaceWrapper">
                                <div class="select-wrapper filters-selectWrapper">
                                    <div class="select-value">
                                        <span class="select-valuePrefix">Added:</span>
                                        <span>Anytime</span>
                                        <div class="no-svg-chevron select-chevron">
                                            <svg viewBox="0 0 7.6 4.1">
                                                <path d="M4 4L7.5.5c.2-.2.1-.5-.2-.5h-7C0 0-.1.3.1.5L3.6 4c.1.1.3.1.4 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <select name="addedToSite" class="select">
                                        <option value="">Anytime</option>
                                        <option value="1">Last 24 hours</option>
                                        <option value="3">Last 3 days</option>
                                        <option value="7">Last 7 days</option>
                                        <option value="14">Last 14 days</option>
                                    </select>
                                </div>
                                <div class="addedToSiteAndLetType-flexSpacer"></div>
                            </div>
                        </div>
                        <div id="soldStcFilter" class="includeStatus">
                            <label class="includeStatus-title" for="filters-sold-stc">Include Under Offer, Sold STC</label>
                            <input type="checkbox" class="includeStatus-checkboxNative" id="filters-sold-stc">
                            <label class="includeStatus-checkbox" role="checkbox" tabindex="0" for="filters-sold-stc" aria-checked="false" aria-label="Include Under Offer, Sold STC">
                                <div class="no-svg-checkbox-tick includeStatus-checkboxTick">
                                    <svg viewBox="0 0 378.2 291">
                                        <path class="dst0" d="M357.9 3.3c-4.4-4.4-11.6-4.4-16 0L123.4 221.7c-4.4 4.4-11.6 4.4-16 0l-71.1-71.1c-4.4-4.4-11.6-4.4-16 0l-17 17c-4.4 4.4-4.4 11.6 0 16l104.1 104.1c4.4 4.4 11.6 4.4 16 0l17-17 16-16L374.9 36.3c4.4-4.4 4.4-11.6 0-16l-17-17z"></path>
                                    </svg>
                                </div>
                            </label>
                            <a href="/stc.html" class="info-soldStcFilter" title="Further information" target="_blank">?</a>
                        </div>
                    </div>
                </div>
                <div id="mustHaveDontShow" class="filtersTray-characteristics multi-select-option">
                    <div class="l-container">
                        <div class="filtersTray-filter filtersTray-featureSelection filtersTray-mustHaves">
                            <label class="filters-label">Must Haves:</label>
                            <div class="multiSelect">
                                <div class="multiSelect-header" role="button" tabindex="0">
                                    <div class="multiSelect-option">
                                        <div class="select-value">
                                            <span>Must Haves</span>
                                            <div class="no-svg-chevron select-chevron">
                                                <svg>
                                                    <use xlink:href="#core-icon--chevron"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="multiSelect-options">
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span>Garden</span>
                                        </div>
                                    </div>
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span>Parking</span>
                                        </div>
                                    </div>
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span>New Home</span>
                                        </div>
                                    </div>
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span>Retirement Home</span>
                                        </div>
                                    </div>
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span>Buying Schemes</span>
                                        </div>
                                    </div>
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span>Auction Property</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filtersTray-filter filtersTray-featureSelection filtersTray-dontShow">
                            <label class="filters-label">Don't Show:</label>
                            <div class="multiSelect">
                                <div class="multiSelect-header" role="button" tabindex="0">
                                    <div class="multiSelect-option">
                                        <div class="select-value">
                                            <span>Don't Show</span>
                                            <div class="no-svg-chevron select-chevron">
                                                <svg>
                                                    <use xlink:href="#core-icon--chevron"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="multiSelect-options">
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span data-bind="text: description">New Home</span>
                                        </div>
                                    </div>
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span data-bind="text: description">Retirement Home</span>
                                        </div>
                                    </div>
                                    <div class="multiSelect-option" role="button" tabindex="0">
                                        <div class="search-icon--tick no-svg-tick commercial">
                                            <svg>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon--tick"></use>
                                            </svg>
                                        </div>
                                        <div class="multiSelect-label">
                                            <span data-bind="text: description">Buying Schemes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filters-actions">
                <div class="l-container d-block">
                    <div class="filters-totalResults">
                        <span class="filters-totalResultsCount">61</span>
                        <span>results</span>
                    </div>
                    <div class="filters-action filters-action--clear">
                        <button class="button button--full">Clear</button>
                    </div>
                    <div class="filters-action filters-action--submit">
                        <button class="button button--full button--primary">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="mapSearch-results-container" class="mapSearch-results-container">
        <div class="mapSearch">
            <div class="googleMapsContainer">
                <div class="google-maps-viewport" id="mapElement"></div>
                <div class="mapToolbarAndErrors">
                    <div class="mapToolbar">
                        <div><a class="button exit-button" href="/property-to-rent/find.html?minBedrooms=4&amp;letFurnishType=furnished&amp;keywords=&amp;sortType=6&amp;includeLetAgreed=false&amp;viewType=LIST&amp;channel=RENT&amp;index=0&amp;radius=20.0&amp;locationIdentifier=REGION%5E87220" title="Exit map view"><span>←</span><span class="label">Exit map</span></a></div>
                        <div class="right">
                            <div class="button create-alert-button" title="Create alert">
                                <div class="searchTitle-saveIcons searchTitle--saveable">
                                    <span class="saveSearch-toggle" data-test="save-search-icon" role="button" tabindex="0">
                                        <span class="no-svg-chevron-save-search searchTitle-chevron">
                                            <svg>
                                                <use xlink:href="#search-icon--chevron-save-search"></use>
                                            </svg>
                                        </span>
                                        <span class="no-svg-bell-unsaved-v3 searchTitle-save searchTitle-save--unsaved">
                                            <svg viewBox="0 0 15 16" xmlns="http://www.w3.org/2000/svg">
                                                <g transform="translate(1 1)" fill="none" fill-rule="evenodd">
                                                    <circle stroke="#7E2825" fill="#F6A274" stroke-linecap="round" stroke-linejoin="round" cx="6" cy="12" r="2"></circle>
                                                    <path d="M11.814 2.174a1.745 1.745 0 00-1.025-2.04 1.752 1.752 0 00-2.172.713c1.174.119 2.285.58 3.197 1.327z" stroke="#7E2825" fill="#F6A274" fill-rule="nonzero"></path><path d="M12.745 6.901c.792-2.237-.317-4.698-2.526-5.605-2.21-.906-4.747.059-5.78 2.198l-.912 2.178A3.192 3.192 0 01.96 7.613a1.077 1.077 0 00-.283 2.07l10.328 4.228c.457.197.99.06 1.294-.334.303-.392.299-.94-.012-1.327a3.15 3.15 0 01-.435-3.17l.892-2.179z" stroke="#7E2825" fill="#FFCB91" fill-rule="nonzero"></path>
                                                    <path d="M9.907 3.062a.548.548 0 01-.423 0 2.343 2.343 0 00-1.784 0 2.317 2.317 0 00-1.26 1.251l-.913 2.179a5.285 5.285 0 01-1.392 1.94.546.546 0 01-.947-.265.537.537 0 01.23-.532 4.206 4.206 0 001.109-1.553l.913-2.179C6.16 2.177 8.156 1.356 9.897 2.07c.273.11.408.416.304.69a.541.541 0 01-.294.302z" fill="#FFF"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <i class="searchTitle-saveLabel searchTitle-saveLabel--dark">Create Alert</i>
                                    </span>
                                    <div class="saveSearch" style="visibility: hidden;">
                                        <div class="saveSearch-underlay"></div>
                                        <div id="saveSearch-offsetWrapper" class="saveSearch-widget" style="left: 0px;">
                                            <div role="button" tabindex="0">
                                                <span class="no-svg-cross no-svg-cross saveSearch-closeButton">
                                                    <svg>
                                                        <use xlink:href="#core-icon--cross"></use>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div>
                                                <div class="saveSearch-widgetHeader">
                                                    <h3>Notify me about new...</h3>
                                                </div>
                                                <div class="saveSearch-widgetContext">
                                                    <p class="saveSearch-intro">Properties To Rent in New York, North Shields, Northumberland, within 20 miles, furnished, at least 4 bed</p>
                                                    <div class="saveSearch-frequency">
                                                        <div class="saveSearch-frequencyOption" data-test="save-search-frequency-options" role="button" tabindex="0">
                                                            <span>Instantly</span>
                                                            <span class="no-svg-chevron no-svg-chevron saveSearch-frequencyChevron">
                                                                <svg>
                                                                    <use xlink:href="#core-icon--chevron"></use>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <ul class="saveSearch-frequencyOptions">
                                                            <li class="saveSearch-frequencyOptionsItem" role="button" tabindex="0"><span>Daily</span></li>
                                                            <li class="saveSearch-frequencyOptionsItem" role="button" tabindex="0"><span>Every 3 days</span></li>
                                                            <li class="saveSearch-frequencyOptionsItem" role="button" tabindex="0"><span>Every 7 days</span></li>
                                                        </ul>
                                                    </div>
                                                    <a class="saveSearch-button" data-test="save-search-confirm-button" role="button" tabindex="0">Create Alert</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="button" href="/property-to-rent/draw-a-search.html?locationIdentifier=REGION%5E87220&amp;minBedrooms=4&amp;numberOfPropertiesPerPage=499&amp;includeLetAgreed=false&amp;viewType=MAP&amp;furnishTypes=furnished&amp;viewport=-2.48795%2C-0.612038%2C54.9414%2C55.0517&amp;edit=true" title="Draw a search">
                                <span class="no-svg-pencil icon">
                                    <svg viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.969 17.187H.999v-5l10.603-10.6a2 2 0 012.828 0l2.183 2.182a1.999 1.999 0 01-.004 2.832L5.969 17.187zm-3.969-6l4.969 5m3.031-13l4.969 5" fill="none" fill-rule="evenodd" stroke="#262637" stroke-width="2"></path>
                                    </svg>
                                </span>
                                <span class="label">Draw search</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB197XvOfNbPAI2d8VE4dXJYpnImn8KI7Q"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="<?=base_url()?>/public/assets/js/app.js"></script>
</body>
</html>