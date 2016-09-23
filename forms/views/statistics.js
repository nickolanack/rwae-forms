var total = 0;
var totalsPT = {};
var totalsPTElements = {};

var incrementTotal = function() {
	total++;
	$('stat-total-quarter').innerHTML = 'Total PIF\'s Q8: ' + total;
}


var getProviceTerritory = function(code) {
	return code.split('-')[0].split(' ')[0].toUpperCase();
};


var _initializeCounters = function(key, countersObject, elementsObject, id) {

	if (!countersObject[key]) {
		countersObject[key] = 0;

		var container = $(id);

		var item = new Element('div', {
			styles: {
				color: "cornflowerblue",
				"padding-left": "10px"

			}

		});
		container.appendChild(item);

		elementsObject[key] = item;

	}
}



var _initializePlaceholder = function(id) {


	var placeholder = $(id);
	if (placeholder) {
		var container = placeholder.parentNode;
		container.removeChild(placeholder);
	}

}


var _addCode = function(code, element) {

	var codes = (element.getAttribute('data-codes') || "").split(", ");
	codes.push(code);

	element.setAttribute('data-codes', codes.join(", "));
	element.addClass('has-data-codes');
	element.appendChild(new Element('span',

		{
			'class': 'is-data-codes',
			html: codes.join(", ")
		}
	));

}

var incrementTotalProvinceTerritory = function(code) {

	var pt = getProviceTerritory(code);

	_initializeCounters(pt, totalsPT, totalsPTElements, 'stat-total-quarter-grouped');
	_initializePlaceholder('stat-total-quarter-grouped-empty');


	totalsPT[pt]++;
	totalsPTElements[pt].innerHTML = pt + ': ' + totalsPT[pt];
	totalsPTElements[pt].setAttribute('data-total', totalsPT[pt]);


	_addCode(code, totalsPTElements[pt]);

};

var _sumInt = function() {

	var t = 0;
	var c;
	for (var i = 0; i < arguments.length; i++) {
		c = parseInt(arguments[i]);
		if (!isNaN(c)) {
			t += c;
		}
	}
	return t;

}


var _sumFloat = function() {

	var t = 0;
	var c;
	for (var i = 0; i < arguments.length; i++) {
		c = parseFloat(arguments[i]);
		if (!isNaN(c)) {
			t += c;
		}
	}
	return t;

}

var countHoursPerWeekWorked = function(scheduled) {

	if (scheduled.formData['employed-quarter'] === 'yes') {

		return _sumInt(scheduled.formData['job-1-hours-weekly'],
			scheduled.formData['job-2-hours-weekly'],
			scheduled.formData['job-3-hours-weekly'])

	}

	return 0;
}



var totalsPTAbove = {};
var totalsPTAboveElements = {};
var incrementTotalProvinceTerritoryAbove15 = function(code) {

	var pt = getProviceTerritory(code);

	_initializeCounters(pt, totalsPTAbove, totalsPTAboveElements, 'stat-total-quarter-grouped-over');
	_initializePlaceholder('stat-total-quarter-grouped-empty-over');

	totalsPTAbove[pt]++;
	totalsPTAboveElements[pt].innerHTML = pt + ': ' + totalsPTAbove[pt];
	totalsPTAboveElements[pt].setAttribute('data-total', totalsPTAbove[pt]);


	_addCode(code, totalsPTAboveElements[pt]);

}


var totalsPTBelow = {};
var totalsPTBelowElements = {};
var incrementTotalProvinceTerritoryBelow15 = function(code) {


	var pt = getProviceTerritory(code);

	_initializeCounters(pt, totalsPTBelow, totalsPTBelowElements, 'stat-total-quarter-grouped-under');
	_initializePlaceholder('stat-total-quarter-grouped-empty-under');

	totalsPTBelow[pt]++;
	totalsPTBelowElements[pt].innerHTML = pt + ': ' + totalsPTBelow[pt];
	totalsPTBelowElements[pt].setAttribute('data-total', totalsPTBelow[pt]);


	_addCode(code, totalsPTBelowElements[pt]);

}



var checkRequiredSupports = function(scheduled) {

	if (scheduled.formData["job-supports"] === "yes") {

		return true;

		//TODO: need to check each section...

	}

	return false;
}


var totalsPTAboveSupports = {};
var totalsPTAboveElementsSupports = {};
var incrementTotalProvinceTerritoryAbove15AndSupports = function(code) {

	var pt = getProviceTerritory(code);

	_initializeCounters(pt, totalsPTAboveSupports, totalsPTAboveElementsSupports, 'stat-total-quarter-grouped-over-required');
	_initializePlaceholder('stat-total-quarter-grouped-empty-over-required');

	totalsPTAboveSupports[pt]++;
	totalsPTAboveElementsSupports[pt].innerHTML = pt + ': ' + totalsPTAboveSupports[pt];
	totalsPTAboveElementsSupports[pt].setAttribute('data-total', totalsPTAbove[pt]);


	_addCode(code, totalsPTAboveElementsSupports[pt]);

}


var totalsPTBelowSupports = {};
var totalsPTBelowElementsSupports = {};
var incrementTotalProvinceTerritoryBelow15AndSupports = function(code) {

	var pt = getProviceTerritory(code);

	_initializeCounters(pt, totalsPTBelowSupports, totalsPTBelowElementsSupports, 'stat-total-quarter-grouped-under-required');
	_initializePlaceholder('stat-total-quarter-grouped-empty-under-required');

	totalsPTBelowSupports[pt]++;
	totalsPTBelowElementsSupports[pt].innerHTML = pt + ': ' + totalsPTBelowSupports[pt];
	totalsPTBelowElementsSupports[pt].setAttribute('data-total', totalsPTBelowSupports[pt]);

	_addCode(code, totalsPTBelowElementsSupports[pt]);

}



var totalsPTAboveSupportsDollars = {};
var totalsPTAboveElementsSupportsDollars = {};
var incrementTotalProvinceTerritoryAbove15AndSupportsDollars = function(code, dollars) {

	var pt = getProviceTerritory(code);

	_initializeCounters(pt, totalsPTAboveSupportsDollars, totalsPTAboveElementsSupportsDollars, 'stat-total-quarter-grouped-over-dollar');
	_initializePlaceholder('stat-total-quarter-grouped-empty-over-dollar');

	totalsPTAboveSupportsDollars[pt] += dollars;
	totalsPTAboveElementsSupportsDollars[pt].innerHTML = pt + ': $' + totalsPTAboveSupportsDollars[pt];
	totalsPTAboveElementsSupportsDollars[pt].setAttribute('data-total', totalsPTAbove[pt]);

	_addCode(code, totalsPTAboveElementsSupportsDollars[pt]);

}


var totalsPTBelowSupportsDollars = {};
var totalsPTBelowElementsSupportsDollars = {};
var incrementTotalProvinceTerritoryBelow15AndSupportsDollars = function(code, dollars) {

	var pt = getProviceTerritory(code);

	_initializeCounters(pt, totalsPTBelowSupportsDollars, totalsPTBelowElementsSupportsDollars, 'stat-total-quarter-grouped-under-dollar');
	_initializePlaceholder('stat-total-quarter-grouped-empty-under-dollar');

	totalsPTBelowSupportsDollars[pt] += dollars;
	totalsPTBelowElementsSupportsDollars[pt].innerHTML = pt + ': $' + totalsPTBelowSupportsDollars[pt];
	totalsPTBelowElementsSupportsDollars[pt].setAttribute('data-total', totalsPTBelowSupportsDollars[pt]);

	_addCode(code, totalsPTBelowElementsSupportsDollars[pt]);

}

var totalSupportDollars = function(scheduled) {



	var total = 0;

	for (var i = 1; i < 4; i++) {

		if (scheduled.formData['job-support-' + i + '-external-provider-coach'] !== "yes") {
			total += _sumFloat(scheduled.formData['job-support-' + i + '-coach-total']);
		}

		if (scheduled.formData['job-support-' + i + '-external-provider-transportation'] !== "yes") {
			total += _sumFloat(scheduled.formData['job-support-' + i + '-trans-total']);
		}

		if (scheduled.formData['job-support-' + i + '-external-provider-other'] !== "yes") {
			total += _sumFloat(scheduled.formData['job-support-' + i + '-other-total']);
		}

	}

	return total;
}

//initialize here.


return function(scheduled, addendumsQuarterlies) {



	if (scheduled.formDate.indexOf('2016-04') === 0) {

		incrementTotal();


		var code = scheduled.code;

		incrementTotalProvinceTerritory(code);


		var hours = countHoursPerWeekWorked(scheduled);
		var dollars = totalSupportDollars(scheduled);
		if (hours >= 15) {
			incrementTotalProvinceTerritoryAbove15(code);
			if (checkRequiredSupports(scheduled)) {
				incrementTotalProvinceTerritoryAbove15AndSupports(code);
				//if (dollars > 0) {
				incrementTotalProvinceTerritoryAbove15AndSupportsDollars(code, dollars);
				//}

			}


		} else {
			incrementTotalProvinceTerritoryBelow15(code);
			if (checkRequiredSupports(scheduled)) {
				incrementTotalProvinceTerritoryBelow15AndSupports(code);
				//if (dollars > 0) {
				incrementTotalProvinceTerritoryBelow15AndSupportsDollars(code, dollars);
				//}
			}
		}



	}



}