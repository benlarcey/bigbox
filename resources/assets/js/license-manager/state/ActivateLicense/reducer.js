/**
 * External dependencies.
 */
import { combineReducers } from 'redux';

/**
 * Internal dependencies.
 */
export const LICENSE_REQUEST         = 'license/REQUEST';
export const LICENSE_REQUEST_SUCCESS = 'license/REQUEST_SUCCESS';
export const LICENSE_REQUEST_FAILURE = 'license/REQUEST_FAILURE';

export const INITIAL_STATE = {
	license: '',
	validLicense: false,
	isSubmitting: false,
};

export function activateLicense(state = {}, action) {
	switch (action.type) {
		case LICENSE_REQUEST:
			return {
				...state,
				license: '',
				validLicense: false,
				isSubmitting: true,
			};
		case LICENSE_REQUEST_SUCCESS:
			return {
				...state,
				license: action.license,
				validLicense: action.validLicense,
				isSubmitting: false,
			};
		case LICENSE_REQUEST_FAILURE:
			return {
				...state,
				license: '',
				validLicense: false,
				isSubmitting: false,
			};
		default:
			return {
				...state,
				INITIAL_STATE,
			};
	}
}
