/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! regenerator-runtime */ "./node_modules/regenerator-runtime/runtime.js");


/***/ }),

/***/ "./node_modules/axios/index.js":
/*!*************************************!*\
  !*** ./node_modules/axios/index.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! ./lib/axios */ "./node_modules/axios/lib/axios.js");

/***/ }),

/***/ "./node_modules/axios/lib/adapters/xhr.js":
/*!************************************************!*\
  !*** ./node_modules/axios/lib/adapters/xhr.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");
var settle = __webpack_require__(/*! ./../core/settle */ "./node_modules/axios/lib/core/settle.js");
var buildURL = __webpack_require__(/*! ./../helpers/buildURL */ "./node_modules/axios/lib/helpers/buildURL.js");
var parseHeaders = __webpack_require__(/*! ./../helpers/parseHeaders */ "./node_modules/axios/lib/helpers/parseHeaders.js");
var isURLSameOrigin = __webpack_require__(/*! ./../helpers/isURLSameOrigin */ "./node_modules/axios/lib/helpers/isURLSameOrigin.js");
var createError = __webpack_require__(/*! ../core/createError */ "./node_modules/axios/lib/core/createError.js");

module.exports = function xhrAdapter(config) {
  return new Promise(function dispatchXhrRequest(resolve, reject) {
    var requestData = config.data;
    var requestHeaders = config.headers;

    if (utils.isFormData(requestData)) {
      delete requestHeaders['Content-Type']; // Let the browser set it
    }

    var request = new XMLHttpRequest();

    // HTTP basic authentication
    if (config.auth) {
      var username = config.auth.username || '';
      var password = config.auth.password || '';
      requestHeaders.Authorization = 'Basic ' + btoa(username + ':' + password);
    }

    request.open(config.method.toUpperCase(), buildURL(config.url, config.params, config.paramsSerializer), true);

    // Set the request timeout in MS
    request.timeout = config.timeout;

    // Listen for ready state
    request.onreadystatechange = function handleLoad() {
      if (!request || request.readyState !== 4) {
        return;
      }

      // The request errored out and we didn't get a response, this will be
      // handled by onerror instead
      // With one exception: request that using file: protocol, most browsers
      // will return status as 0 even though it's a successful request
      if (request.status === 0 && !(request.responseURL && request.responseURL.indexOf('file:') === 0)) {
        return;
      }

      // Prepare the response
      var responseHeaders = 'getAllResponseHeaders' in request ? parseHeaders(request.getAllResponseHeaders()) : null;
      var responseData = !config.responseType || config.responseType === 'text' ? request.responseText : request.response;
      var response = {
        data: responseData,
        status: request.status,
        statusText: request.statusText,
        headers: responseHeaders,
        config: config,
        request: request
      };

      settle(resolve, reject, response);

      // Clean up request
      request = null;
    };

    // Handle low level network errors
    request.onerror = function handleError() {
      // Real errors are hidden from us by the browser
      // onerror should only fire if it's a network error
      reject(createError('Network Error', config, null, request));

      // Clean up request
      request = null;
    };

    // Handle timeout
    request.ontimeout = function handleTimeout() {
      reject(createError('timeout of ' + config.timeout + 'ms exceeded', config, 'ECONNABORTED',
        request));

      // Clean up request
      request = null;
    };

    // Add xsrf header
    // This is only done if running in a standard browser environment.
    // Specifically not if we're in a web worker, or react-native.
    if (utils.isStandardBrowserEnv()) {
      var cookies = __webpack_require__(/*! ./../helpers/cookies */ "./node_modules/axios/lib/helpers/cookies.js");

      // Add xsrf header
      var xsrfValue = (config.withCredentials || isURLSameOrigin(config.url)) && config.xsrfCookieName ?
          cookies.read(config.xsrfCookieName) :
          undefined;

      if (xsrfValue) {
        requestHeaders[config.xsrfHeaderName] = xsrfValue;
      }
    }

    // Add headers to the request
    if ('setRequestHeader' in request) {
      utils.forEach(requestHeaders, function setRequestHeader(val, key) {
        if (typeof requestData === 'undefined' && key.toLowerCase() === 'content-type') {
          // Remove Content-Type if data is undefined
          delete requestHeaders[key];
        } else {
          // Otherwise add header to the request
          request.setRequestHeader(key, val);
        }
      });
    }

    // Add withCredentials to request if needed
    if (config.withCredentials) {
      request.withCredentials = true;
    }

    // Add responseType to request if needed
    if (config.responseType) {
      try {
        request.responseType = config.responseType;
      } catch (e) {
        // Expected DOMException thrown by browsers not compatible XMLHttpRequest Level 2.
        // But, this can be suppressed for 'json' type as it can be parsed by default 'transformResponse' function.
        if (config.responseType !== 'json') {
          throw e;
        }
      }
    }

    // Handle progress if needed
    if (typeof config.onDownloadProgress === 'function') {
      request.addEventListener('progress', config.onDownloadProgress);
    }

    // Not all browsers support upload events
    if (typeof config.onUploadProgress === 'function' && request.upload) {
      request.upload.addEventListener('progress', config.onUploadProgress);
    }

    if (config.cancelToken) {
      // Handle cancellation
      config.cancelToken.promise.then(function onCanceled(cancel) {
        if (!request) {
          return;
        }

        request.abort();
        reject(cancel);
        // Clean up request
        request = null;
      });
    }

    if (requestData === undefined) {
      requestData = null;
    }

    // Send the request
    request.send(requestData);
  });
};


/***/ }),

/***/ "./node_modules/axios/lib/axios.js":
/*!*****************************************!*\
  !*** ./node_modules/axios/lib/axios.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./utils */ "./node_modules/axios/lib/utils.js");
var bind = __webpack_require__(/*! ./helpers/bind */ "./node_modules/axios/lib/helpers/bind.js");
var Axios = __webpack_require__(/*! ./core/Axios */ "./node_modules/axios/lib/core/Axios.js");
var defaults = __webpack_require__(/*! ./defaults */ "./node_modules/axios/lib/defaults.js");

/**
 * Create an instance of Axios
 *
 * @param {Object} defaultConfig The default config for the instance
 * @return {Axios} A new instance of Axios
 */
function createInstance(defaultConfig) {
  var context = new Axios(defaultConfig);
  var instance = bind(Axios.prototype.request, context);

  // Copy axios.prototype to instance
  utils.extend(instance, Axios.prototype, context);

  // Copy context to instance
  utils.extend(instance, context);

  return instance;
}

// Create the default instance to be exported
var axios = createInstance(defaults);

// Expose Axios class to allow class inheritance
axios.Axios = Axios;

// Factory for creating new instances
axios.create = function create(instanceConfig) {
  return createInstance(utils.merge(defaults, instanceConfig));
};

// Expose Cancel & CancelToken
axios.Cancel = __webpack_require__(/*! ./cancel/Cancel */ "./node_modules/axios/lib/cancel/Cancel.js");
axios.CancelToken = __webpack_require__(/*! ./cancel/CancelToken */ "./node_modules/axios/lib/cancel/CancelToken.js");
axios.isCancel = __webpack_require__(/*! ./cancel/isCancel */ "./node_modules/axios/lib/cancel/isCancel.js");

// Expose all/spread
axios.all = function all(promises) {
  return Promise.all(promises);
};
axios.spread = __webpack_require__(/*! ./helpers/spread */ "./node_modules/axios/lib/helpers/spread.js");

module.exports = axios;

// Allow use of default import syntax in TypeScript
module.exports.default = axios;


/***/ }),

/***/ "./node_modules/axios/lib/cancel/Cancel.js":
/*!*************************************************!*\
  !*** ./node_modules/axios/lib/cancel/Cancel.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/**
 * A `Cancel` is an object that is thrown when an operation is canceled.
 *
 * @class
 * @param {string=} message The message.
 */
function Cancel(message) {
  this.message = message;
}

Cancel.prototype.toString = function toString() {
  return 'Cancel' + (this.message ? ': ' + this.message : '');
};

Cancel.prototype.__CANCEL__ = true;

module.exports = Cancel;


/***/ }),

/***/ "./node_modules/axios/lib/cancel/CancelToken.js":
/*!******************************************************!*\
  !*** ./node_modules/axios/lib/cancel/CancelToken.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var Cancel = __webpack_require__(/*! ./Cancel */ "./node_modules/axios/lib/cancel/Cancel.js");

/**
 * A `CancelToken` is an object that can be used to request cancellation of an operation.
 *
 * @class
 * @param {Function} executor The executor function.
 */
function CancelToken(executor) {
  if (typeof executor !== 'function') {
    throw new TypeError('executor must be a function.');
  }

  var resolvePromise;
  this.promise = new Promise(function promiseExecutor(resolve) {
    resolvePromise = resolve;
  });

  var token = this;
  executor(function cancel(message) {
    if (token.reason) {
      // Cancellation has already been requested
      return;
    }

    token.reason = new Cancel(message);
    resolvePromise(token.reason);
  });
}

/**
 * Throws a `Cancel` if cancellation has been requested.
 */
CancelToken.prototype.throwIfRequested = function throwIfRequested() {
  if (this.reason) {
    throw this.reason;
  }
};

/**
 * Returns an object that contains a new `CancelToken` and a function that, when called,
 * cancels the `CancelToken`.
 */
CancelToken.source = function source() {
  var cancel;
  var token = new CancelToken(function executor(c) {
    cancel = c;
  });
  return {
    token: token,
    cancel: cancel
  };
};

module.exports = CancelToken;


/***/ }),

/***/ "./node_modules/axios/lib/cancel/isCancel.js":
/*!***************************************************!*\
  !*** ./node_modules/axios/lib/cancel/isCancel.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = function isCancel(value) {
  return !!(value && value.__CANCEL__);
};


/***/ }),

/***/ "./node_modules/axios/lib/core/Axios.js":
/*!**********************************************!*\
  !*** ./node_modules/axios/lib/core/Axios.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var defaults = __webpack_require__(/*! ./../defaults */ "./node_modules/axios/lib/defaults.js");
var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");
var InterceptorManager = __webpack_require__(/*! ./InterceptorManager */ "./node_modules/axios/lib/core/InterceptorManager.js");
var dispatchRequest = __webpack_require__(/*! ./dispatchRequest */ "./node_modules/axios/lib/core/dispatchRequest.js");

/**
 * Create a new instance of Axios
 *
 * @param {Object} instanceConfig The default config for the instance
 */
function Axios(instanceConfig) {
  this.defaults = instanceConfig;
  this.interceptors = {
    request: new InterceptorManager(),
    response: new InterceptorManager()
  };
}

/**
 * Dispatch a request
 *
 * @param {Object} config The config specific for this request (merged with this.defaults)
 */
Axios.prototype.request = function request(config) {
  /*eslint no-param-reassign:0*/
  // Allow for axios('example/url'[, config]) a la fetch API
  if (typeof config === 'string') {
    config = utils.merge({
      url: arguments[0]
    }, arguments[1]);
  }

  config = utils.merge(defaults, {method: 'get'}, this.defaults, config);
  config.method = config.method.toLowerCase();

  // Hook up interceptors middleware
  var chain = [dispatchRequest, undefined];
  var promise = Promise.resolve(config);

  this.interceptors.request.forEach(function unshiftRequestInterceptors(interceptor) {
    chain.unshift(interceptor.fulfilled, interceptor.rejected);
  });

  this.interceptors.response.forEach(function pushResponseInterceptors(interceptor) {
    chain.push(interceptor.fulfilled, interceptor.rejected);
  });

  while (chain.length) {
    promise = promise.then(chain.shift(), chain.shift());
  }

  return promise;
};

// Provide aliases for supported request methods
utils.forEach(['delete', 'get', 'head', 'options'], function forEachMethodNoData(method) {
  /*eslint func-names:0*/
  Axios.prototype[method] = function(url, config) {
    return this.request(utils.merge(config || {}, {
      method: method,
      url: url
    }));
  };
});

utils.forEach(['post', 'put', 'patch'], function forEachMethodWithData(method) {
  /*eslint func-names:0*/
  Axios.prototype[method] = function(url, data, config) {
    return this.request(utils.merge(config || {}, {
      method: method,
      url: url,
      data: data
    }));
  };
});

module.exports = Axios;


/***/ }),

/***/ "./node_modules/axios/lib/core/InterceptorManager.js":
/*!***********************************************************!*\
  !*** ./node_modules/axios/lib/core/InterceptorManager.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");

function InterceptorManager() {
  this.handlers = [];
}

/**
 * Add a new interceptor to the stack
 *
 * @param {Function} fulfilled The function to handle `then` for a `Promise`
 * @param {Function} rejected The function to handle `reject` for a `Promise`
 *
 * @return {Number} An ID used to remove interceptor later
 */
InterceptorManager.prototype.use = function use(fulfilled, rejected) {
  this.handlers.push({
    fulfilled: fulfilled,
    rejected: rejected
  });
  return this.handlers.length - 1;
};

/**
 * Remove an interceptor from the stack
 *
 * @param {Number} id The ID that was returned by `use`
 */
InterceptorManager.prototype.eject = function eject(id) {
  if (this.handlers[id]) {
    this.handlers[id] = null;
  }
};

/**
 * Iterate over all the registered interceptors
 *
 * This method is particularly useful for skipping over any
 * interceptors that may have become `null` calling `eject`.
 *
 * @param {Function} fn The function to call for each interceptor
 */
InterceptorManager.prototype.forEach = function forEach(fn) {
  utils.forEach(this.handlers, function forEachHandler(h) {
    if (h !== null) {
      fn(h);
    }
  });
};

module.exports = InterceptorManager;


/***/ }),

/***/ "./node_modules/axios/lib/core/createError.js":
/*!****************************************************!*\
  !*** ./node_modules/axios/lib/core/createError.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var enhanceError = __webpack_require__(/*! ./enhanceError */ "./node_modules/axios/lib/core/enhanceError.js");

/**
 * Create an Error with the specified message, config, error code, request and response.
 *
 * @param {string} message The error message.
 * @param {Object} config The config.
 * @param {string} [code] The error code (for example, 'ECONNABORTED').
 * @param {Object} [request] The request.
 * @param {Object} [response] The response.
 * @returns {Error} The created error.
 */
module.exports = function createError(message, config, code, request, response) {
  var error = new Error(message);
  return enhanceError(error, config, code, request, response);
};


/***/ }),

/***/ "./node_modules/axios/lib/core/dispatchRequest.js":
/*!********************************************************!*\
  !*** ./node_modules/axios/lib/core/dispatchRequest.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");
var transformData = __webpack_require__(/*! ./transformData */ "./node_modules/axios/lib/core/transformData.js");
var isCancel = __webpack_require__(/*! ../cancel/isCancel */ "./node_modules/axios/lib/cancel/isCancel.js");
var defaults = __webpack_require__(/*! ../defaults */ "./node_modules/axios/lib/defaults.js");
var isAbsoluteURL = __webpack_require__(/*! ./../helpers/isAbsoluteURL */ "./node_modules/axios/lib/helpers/isAbsoluteURL.js");
var combineURLs = __webpack_require__(/*! ./../helpers/combineURLs */ "./node_modules/axios/lib/helpers/combineURLs.js");

/**
 * Throws a `Cancel` if cancellation has been requested.
 */
function throwIfCancellationRequested(config) {
  if (config.cancelToken) {
    config.cancelToken.throwIfRequested();
  }
}

/**
 * Dispatch a request to the server using the configured adapter.
 *
 * @param {object} config The config that is to be used for the request
 * @returns {Promise} The Promise to be fulfilled
 */
module.exports = function dispatchRequest(config) {
  throwIfCancellationRequested(config);

  // Support baseURL config
  if (config.baseURL && !isAbsoluteURL(config.url)) {
    config.url = combineURLs(config.baseURL, config.url);
  }

  // Ensure headers exist
  config.headers = config.headers || {};

  // Transform request data
  config.data = transformData(
    config.data,
    config.headers,
    config.transformRequest
  );

  // Flatten headers
  config.headers = utils.merge(
    config.headers.common || {},
    config.headers[config.method] || {},
    config.headers || {}
  );

  utils.forEach(
    ['delete', 'get', 'head', 'post', 'put', 'patch', 'common'],
    function cleanHeaderConfig(method) {
      delete config.headers[method];
    }
  );

  var adapter = config.adapter || defaults.adapter;

  return adapter(config).then(function onAdapterResolution(response) {
    throwIfCancellationRequested(config);

    // Transform response data
    response.data = transformData(
      response.data,
      response.headers,
      config.transformResponse
    );

    return response;
  }, function onAdapterRejection(reason) {
    if (!isCancel(reason)) {
      throwIfCancellationRequested(config);

      // Transform response data
      if (reason && reason.response) {
        reason.response.data = transformData(
          reason.response.data,
          reason.response.headers,
          config.transformResponse
        );
      }
    }

    return Promise.reject(reason);
  });
};


/***/ }),

/***/ "./node_modules/axios/lib/core/enhanceError.js":
/*!*****************************************************!*\
  !*** ./node_modules/axios/lib/core/enhanceError.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/**
 * Update an Error with the specified config, error code, and response.
 *
 * @param {Error} error The error to update.
 * @param {Object} config The config.
 * @param {string} [code] The error code (for example, 'ECONNABORTED').
 * @param {Object} [request] The request.
 * @param {Object} [response] The response.
 * @returns {Error} The error.
 */
module.exports = function enhanceError(error, config, code, request, response) {
  error.config = config;
  if (code) {
    error.code = code;
  }
  error.request = request;
  error.response = response;
  return error;
};


/***/ }),

/***/ "./node_modules/axios/lib/core/settle.js":
/*!***********************************************!*\
  !*** ./node_modules/axios/lib/core/settle.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var createError = __webpack_require__(/*! ./createError */ "./node_modules/axios/lib/core/createError.js");

/**
 * Resolve or reject a Promise based on response status.
 *
 * @param {Function} resolve A function that resolves the promise.
 * @param {Function} reject A function that rejects the promise.
 * @param {object} response The response.
 */
module.exports = function settle(resolve, reject, response) {
  var validateStatus = response.config.validateStatus;
  // Note: status is not exposed by XDomainRequest
  if (!response.status || !validateStatus || validateStatus(response.status)) {
    resolve(response);
  } else {
    reject(createError(
      'Request failed with status code ' + response.status,
      response.config,
      null,
      response.request,
      response
    ));
  }
};


/***/ }),

/***/ "./node_modules/axios/lib/core/transformData.js":
/*!******************************************************!*\
  !*** ./node_modules/axios/lib/core/transformData.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");

/**
 * Transform the data for a request or a response
 *
 * @param {Object|String} data The data to be transformed
 * @param {Array} headers The headers for the request or response
 * @param {Array|Function} fns A single function or Array of functions
 * @returns {*} The resulting transformed data
 */
module.exports = function transformData(data, headers, fns) {
  /*eslint no-param-reassign:0*/
  utils.forEach(fns, function transform(fn) {
    data = fn(data, headers);
  });

  return data;
};


/***/ }),

/***/ "./node_modules/axios/lib/defaults.js":
/*!********************************************!*\
  !*** ./node_modules/axios/lib/defaults.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(process) {

var utils = __webpack_require__(/*! ./utils */ "./node_modules/axios/lib/utils.js");
var normalizeHeaderName = __webpack_require__(/*! ./helpers/normalizeHeaderName */ "./node_modules/axios/lib/helpers/normalizeHeaderName.js");

var DEFAULT_CONTENT_TYPE = {
  'Content-Type': 'application/x-www-form-urlencoded'
};

function setContentTypeIfUnset(headers, value) {
  if (!utils.isUndefined(headers) && utils.isUndefined(headers['Content-Type'])) {
    headers['Content-Type'] = value;
  }
}

function getDefaultAdapter() {
  var adapter;
  if (typeof XMLHttpRequest !== 'undefined') {
    // For browsers use XHR adapter
    adapter = __webpack_require__(/*! ./adapters/xhr */ "./node_modules/axios/lib/adapters/xhr.js");
  } else if (typeof process !== 'undefined') {
    // For node use HTTP adapter
    adapter = __webpack_require__(/*! ./adapters/http */ "./node_modules/axios/lib/adapters/xhr.js");
  }
  return adapter;
}

var defaults = {
  adapter: getDefaultAdapter(),

  transformRequest: [function transformRequest(data, headers) {
    normalizeHeaderName(headers, 'Content-Type');
    if (utils.isFormData(data) ||
      utils.isArrayBuffer(data) ||
      utils.isBuffer(data) ||
      utils.isStream(data) ||
      utils.isFile(data) ||
      utils.isBlob(data)
    ) {
      return data;
    }
    if (utils.isArrayBufferView(data)) {
      return data.buffer;
    }
    if (utils.isURLSearchParams(data)) {
      setContentTypeIfUnset(headers, 'application/x-www-form-urlencoded;charset=utf-8');
      return data.toString();
    }
    if (utils.isObject(data)) {
      setContentTypeIfUnset(headers, 'application/json;charset=utf-8');
      return JSON.stringify(data);
    }
    return data;
  }],

  transformResponse: [function transformResponse(data) {
    /*eslint no-param-reassign:0*/
    if (typeof data === 'string') {
      try {
        data = JSON.parse(data);
      } catch (e) { /* Ignore */ }
    }
    return data;
  }],

  /**
   * A timeout in milliseconds to abort a request. If set to 0 (default) a
   * timeout is not created.
   */
  timeout: 0,

  xsrfCookieName: 'XSRF-TOKEN',
  xsrfHeaderName: 'X-XSRF-TOKEN',

  maxContentLength: -1,

  validateStatus: function validateStatus(status) {
    return status >= 200 && status < 300;
  }
};

defaults.headers = {
  common: {
    'Accept': 'application/json, text/plain, */*'
  }
};

utils.forEach(['delete', 'get', 'head'], function forEachMethodNoData(method) {
  defaults.headers[method] = {};
});

utils.forEach(['post', 'put', 'patch'], function forEachMethodWithData(method) {
  defaults.headers[method] = utils.merge(DEFAULT_CONTENT_TYPE);
});

module.exports = defaults;

/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../process/browser.js */ "./node_modules/process/browser.js")))

/***/ }),

/***/ "./node_modules/axios/lib/helpers/bind.js":
/*!************************************************!*\
  !*** ./node_modules/axios/lib/helpers/bind.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = function bind(fn, thisArg) {
  return function wrap() {
    var args = new Array(arguments.length);
    for (var i = 0; i < args.length; i++) {
      args[i] = arguments[i];
    }
    return fn.apply(thisArg, args);
  };
};


/***/ }),

/***/ "./node_modules/axios/lib/helpers/buildURL.js":
/*!****************************************************!*\
  !*** ./node_modules/axios/lib/helpers/buildURL.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");

function encode(val) {
  return encodeURIComponent(val).
    replace(/%40/gi, '@').
    replace(/%3A/gi, ':').
    replace(/%24/g, '$').
    replace(/%2C/gi, ',').
    replace(/%20/g, '+').
    replace(/%5B/gi, '[').
    replace(/%5D/gi, ']');
}

/**
 * Build a URL by appending params to the end
 *
 * @param {string} url The base of the url (e.g., http://www.google.com)
 * @param {object} [params] The params to be appended
 * @returns {string} The formatted url
 */
module.exports = function buildURL(url, params, paramsSerializer) {
  /*eslint no-param-reassign:0*/
  if (!params) {
    return url;
  }

  var serializedParams;
  if (paramsSerializer) {
    serializedParams = paramsSerializer(params);
  } else if (utils.isURLSearchParams(params)) {
    serializedParams = params.toString();
  } else {
    var parts = [];

    utils.forEach(params, function serialize(val, key) {
      if (val === null || typeof val === 'undefined') {
        return;
      }

      if (utils.isArray(val)) {
        key = key + '[]';
      } else {
        val = [val];
      }

      utils.forEach(val, function parseValue(v) {
        if (utils.isDate(v)) {
          v = v.toISOString();
        } else if (utils.isObject(v)) {
          v = JSON.stringify(v);
        }
        parts.push(encode(key) + '=' + encode(v));
      });
    });

    serializedParams = parts.join('&');
  }

  if (serializedParams) {
    url += (url.indexOf('?') === -1 ? '?' : '&') + serializedParams;
  }

  return url;
};


/***/ }),

/***/ "./node_modules/axios/lib/helpers/combineURLs.js":
/*!*******************************************************!*\
  !*** ./node_modules/axios/lib/helpers/combineURLs.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/**
 * Creates a new URL by combining the specified URLs
 *
 * @param {string} baseURL The base URL
 * @param {string} relativeURL The relative URL
 * @returns {string} The combined URL
 */
module.exports = function combineURLs(baseURL, relativeURL) {
  return relativeURL
    ? baseURL.replace(/\/+$/, '') + '/' + relativeURL.replace(/^\/+/, '')
    : baseURL;
};


/***/ }),

/***/ "./node_modules/axios/lib/helpers/cookies.js":
/*!***************************************************!*\
  !*** ./node_modules/axios/lib/helpers/cookies.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");

module.exports = (
  utils.isStandardBrowserEnv() ?

  // Standard browser envs support document.cookie
  (function standardBrowserEnv() {
    return {
      write: function write(name, value, expires, path, domain, secure) {
        var cookie = [];
        cookie.push(name + '=' + encodeURIComponent(value));

        if (utils.isNumber(expires)) {
          cookie.push('expires=' + new Date(expires).toGMTString());
        }

        if (utils.isString(path)) {
          cookie.push('path=' + path);
        }

        if (utils.isString(domain)) {
          cookie.push('domain=' + domain);
        }

        if (secure === true) {
          cookie.push('secure');
        }

        document.cookie = cookie.join('; ');
      },

      read: function read(name) {
        var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
        return (match ? decodeURIComponent(match[3]) : null);
      },

      remove: function remove(name) {
        this.write(name, '', Date.now() - 86400000);
      }
    };
  })() :

  // Non standard browser env (web workers, react-native) lack needed support.
  (function nonStandardBrowserEnv() {
    return {
      write: function write() {},
      read: function read() { return null; },
      remove: function remove() {}
    };
  })()
);


/***/ }),

/***/ "./node_modules/axios/lib/helpers/isAbsoluteURL.js":
/*!*********************************************************!*\
  !*** ./node_modules/axios/lib/helpers/isAbsoluteURL.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/**
 * Determines whether the specified URL is absolute
 *
 * @param {string} url The URL to test
 * @returns {boolean} True if the specified URL is absolute, otherwise false
 */
module.exports = function isAbsoluteURL(url) {
  // A URL is considered absolute if it begins with "<scheme>://" or "//" (protocol-relative URL).
  // RFC 3986 defines scheme name as a sequence of characters beginning with a letter and followed
  // by any combination of letters, digits, plus, period, or hyphen.
  return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(url);
};


/***/ }),

/***/ "./node_modules/axios/lib/helpers/isURLSameOrigin.js":
/*!***********************************************************!*\
  !*** ./node_modules/axios/lib/helpers/isURLSameOrigin.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");

module.exports = (
  utils.isStandardBrowserEnv() ?

  // Standard browser envs have full support of the APIs needed to test
  // whether the request URL is of the same origin as current location.
  (function standardBrowserEnv() {
    var msie = /(msie|trident)/i.test(navigator.userAgent);
    var urlParsingNode = document.createElement('a');
    var originURL;

    /**
    * Parse a URL to discover it's components
    *
    * @param {String} url The URL to be parsed
    * @returns {Object}
    */
    function resolveURL(url) {
      var href = url;

      if (msie) {
        // IE needs attribute set twice to normalize properties
        urlParsingNode.setAttribute('href', href);
        href = urlParsingNode.href;
      }

      urlParsingNode.setAttribute('href', href);

      // urlParsingNode provides the UrlUtils interface - http://url.spec.whatwg.org/#urlutils
      return {
        href: urlParsingNode.href,
        protocol: urlParsingNode.protocol ? urlParsingNode.protocol.replace(/:$/, '') : '',
        host: urlParsingNode.host,
        search: urlParsingNode.search ? urlParsingNode.search.replace(/^\?/, '') : '',
        hash: urlParsingNode.hash ? urlParsingNode.hash.replace(/^#/, '') : '',
        hostname: urlParsingNode.hostname,
        port: urlParsingNode.port,
        pathname: (urlParsingNode.pathname.charAt(0) === '/') ?
                  urlParsingNode.pathname :
                  '/' + urlParsingNode.pathname
      };
    }

    originURL = resolveURL(window.location.href);

    /**
    * Determine if a URL shares the same origin as the current location
    *
    * @param {String} requestURL The URL to test
    * @returns {boolean} True if URL shares the same origin, otherwise false
    */
    return function isURLSameOrigin(requestURL) {
      var parsed = (utils.isString(requestURL)) ? resolveURL(requestURL) : requestURL;
      return (parsed.protocol === originURL.protocol &&
            parsed.host === originURL.host);
    };
  })() :

  // Non standard browser envs (web workers, react-native) lack needed support.
  (function nonStandardBrowserEnv() {
    return function isURLSameOrigin() {
      return true;
    };
  })()
);


/***/ }),

/***/ "./node_modules/axios/lib/helpers/normalizeHeaderName.js":
/*!***************************************************************!*\
  !*** ./node_modules/axios/lib/helpers/normalizeHeaderName.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ../utils */ "./node_modules/axios/lib/utils.js");

module.exports = function normalizeHeaderName(headers, normalizedName) {
  utils.forEach(headers, function processHeader(value, name) {
    if (name !== normalizedName && name.toUpperCase() === normalizedName.toUpperCase()) {
      headers[normalizedName] = value;
      delete headers[name];
    }
  });
};


/***/ }),

/***/ "./node_modules/axios/lib/helpers/parseHeaders.js":
/*!********************************************************!*\
  !*** ./node_modules/axios/lib/helpers/parseHeaders.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "./node_modules/axios/lib/utils.js");

// Headers whose duplicates are ignored by node
// c.f. https://nodejs.org/api/http.html#http_message_headers
var ignoreDuplicateOf = [
  'age', 'authorization', 'content-length', 'content-type', 'etag',
  'expires', 'from', 'host', 'if-modified-since', 'if-unmodified-since',
  'last-modified', 'location', 'max-forwards', 'proxy-authorization',
  'referer', 'retry-after', 'user-agent'
];

/**
 * Parse headers into an object
 *
 * ```
 * Date: Wed, 27 Aug 2014 08:58:49 GMT
 * Content-Type: application/json
 * Connection: keep-alive
 * Transfer-Encoding: chunked
 * ```
 *
 * @param {String} headers Headers needing to be parsed
 * @returns {Object} Headers parsed into an object
 */
module.exports = function parseHeaders(headers) {
  var parsed = {};
  var key;
  var val;
  var i;

  if (!headers) { return parsed; }

  utils.forEach(headers.split('\n'), function parser(line) {
    i = line.indexOf(':');
    key = utils.trim(line.substr(0, i)).toLowerCase();
    val = utils.trim(line.substr(i + 1));

    if (key) {
      if (parsed[key] && ignoreDuplicateOf.indexOf(key) >= 0) {
        return;
      }
      if (key === 'set-cookie') {
        parsed[key] = (parsed[key] ? parsed[key] : []).concat([val]);
      } else {
        parsed[key] = parsed[key] ? parsed[key] + ', ' + val : val;
      }
    }
  });

  return parsed;
};


/***/ }),

/***/ "./node_modules/axios/lib/helpers/spread.js":
/*!**************************************************!*\
  !*** ./node_modules/axios/lib/helpers/spread.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/**
 * Syntactic sugar for invoking a function and expanding an array for arguments.
 *
 * Common use case would be to use `Function.prototype.apply`.
 *
 *  ```js
 *  function f(x, y, z) {}
 *  var args = [1, 2, 3];
 *  f.apply(null, args);
 *  ```
 *
 * With `spread` this example can be re-written.
 *
 *  ```js
 *  spread(function(x, y, z) {})([1, 2, 3]);
 *  ```
 *
 * @param {Function} callback
 * @returns {Function}
 */
module.exports = function spread(callback) {
  return function wrap(arr) {
    return callback.apply(null, arr);
  };
};


/***/ }),

/***/ "./node_modules/axios/lib/utils.js":
/*!*****************************************!*\
  !*** ./node_modules/axios/lib/utils.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var bind = __webpack_require__(/*! ./helpers/bind */ "./node_modules/axios/lib/helpers/bind.js");
var isBuffer = __webpack_require__(/*! is-buffer */ "./node_modules/axios/node_modules/is-buffer/index.js");

/*global toString:true*/

// utils is a library of generic helper functions non-specific to axios

var toString = Object.prototype.toString;

/**
 * Determine if a value is an Array
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is an Array, otherwise false
 */
function isArray(val) {
  return toString.call(val) === '[object Array]';
}

/**
 * Determine if a value is an ArrayBuffer
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is an ArrayBuffer, otherwise false
 */
function isArrayBuffer(val) {
  return toString.call(val) === '[object ArrayBuffer]';
}

/**
 * Determine if a value is a FormData
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is an FormData, otherwise false
 */
function isFormData(val) {
  return (typeof FormData !== 'undefined') && (val instanceof FormData);
}

/**
 * Determine if a value is a view on an ArrayBuffer
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a view on an ArrayBuffer, otherwise false
 */
function isArrayBufferView(val) {
  var result;
  if ((typeof ArrayBuffer !== 'undefined') && (ArrayBuffer.isView)) {
    result = ArrayBuffer.isView(val);
  } else {
    result = (val) && (val.buffer) && (val.buffer instanceof ArrayBuffer);
  }
  return result;
}

/**
 * Determine if a value is a String
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a String, otherwise false
 */
function isString(val) {
  return typeof val === 'string';
}

/**
 * Determine if a value is a Number
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Number, otherwise false
 */
function isNumber(val) {
  return typeof val === 'number';
}

/**
 * Determine if a value is undefined
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if the value is undefined, otherwise false
 */
function isUndefined(val) {
  return typeof val === 'undefined';
}

/**
 * Determine if a value is an Object
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is an Object, otherwise false
 */
function isObject(val) {
  return val !== null && typeof val === 'object';
}

/**
 * Determine if a value is a Date
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Date, otherwise false
 */
function isDate(val) {
  return toString.call(val) === '[object Date]';
}

/**
 * Determine if a value is a File
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a File, otherwise false
 */
function isFile(val) {
  return toString.call(val) === '[object File]';
}

/**
 * Determine if a value is a Blob
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Blob, otherwise false
 */
function isBlob(val) {
  return toString.call(val) === '[object Blob]';
}

/**
 * Determine if a value is a Function
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Function, otherwise false
 */
function isFunction(val) {
  return toString.call(val) === '[object Function]';
}

/**
 * Determine if a value is a Stream
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Stream, otherwise false
 */
function isStream(val) {
  return isObject(val) && isFunction(val.pipe);
}

/**
 * Determine if a value is a URLSearchParams object
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a URLSearchParams object, otherwise false
 */
function isURLSearchParams(val) {
  return typeof URLSearchParams !== 'undefined' && val instanceof URLSearchParams;
}

/**
 * Trim excess whitespace off the beginning and end of a string
 *
 * @param {String} str The String to trim
 * @returns {String} The String freed of excess whitespace
 */
function trim(str) {
  return str.replace(/^\s*/, '').replace(/\s*$/, '');
}

/**
 * Determine if we're running in a standard browser environment
 *
 * This allows axios to run in a web worker, and react-native.
 * Both environments support XMLHttpRequest, but not fully standard globals.
 *
 * web workers:
 *  typeof window -> undefined
 *  typeof document -> undefined
 *
 * react-native:
 *  navigator.product -> 'ReactNative'
 */
function isStandardBrowserEnv() {
  if (typeof navigator !== 'undefined' && navigator.product === 'ReactNative') {
    return false;
  }
  return (
    typeof window !== 'undefined' &&
    typeof document !== 'undefined'
  );
}

/**
 * Iterate over an Array or an Object invoking a function for each item.
 *
 * If `obj` is an Array callback will be called passing
 * the value, index, and complete array for each item.
 *
 * If 'obj' is an Object callback will be called passing
 * the value, key, and complete object for each property.
 *
 * @param {Object|Array} obj The object to iterate
 * @param {Function} fn The callback to invoke for each item
 */
function forEach(obj, fn) {
  // Don't bother if no value provided
  if (obj === null || typeof obj === 'undefined') {
    return;
  }

  // Force an array if not already something iterable
  if (typeof obj !== 'object') {
    /*eslint no-param-reassign:0*/
    obj = [obj];
  }

  if (isArray(obj)) {
    // Iterate over array values
    for (var i = 0, l = obj.length; i < l; i++) {
      fn.call(null, obj[i], i, obj);
    }
  } else {
    // Iterate over object keys
    for (var key in obj) {
      if (Object.prototype.hasOwnProperty.call(obj, key)) {
        fn.call(null, obj[key], key, obj);
      }
    }
  }
}

/**
 * Accepts varargs expecting each argument to be an object, then
 * immutably merges the properties of each object and returns result.
 *
 * When multiple objects contain the same key the later object in
 * the arguments list will take precedence.
 *
 * Example:
 *
 * ```js
 * var result = merge({foo: 123}, {foo: 456});
 * console.log(result.foo); // outputs 456
 * ```
 *
 * @param {Object} obj1 Object to merge
 * @returns {Object} Result of all merge properties
 */
function merge(/* obj1, obj2, obj3, ... */) {
  var result = {};
  function assignValue(val, key) {
    if (typeof result[key] === 'object' && typeof val === 'object') {
      result[key] = merge(result[key], val);
    } else {
      result[key] = val;
    }
  }

  for (var i = 0, l = arguments.length; i < l; i++) {
    forEach(arguments[i], assignValue);
  }
  return result;
}

/**
 * Extends object a by mutably adding to it the properties of object b.
 *
 * @param {Object} a The object to be extended
 * @param {Object} b The object to copy properties from
 * @param {Object} thisArg The object to bind function to
 * @return {Object} The resulting value of object a
 */
function extend(a, b, thisArg) {
  forEach(b, function assignValue(val, key) {
    if (thisArg && typeof val === 'function') {
      a[key] = bind(val, thisArg);
    } else {
      a[key] = val;
    }
  });
  return a;
}

module.exports = {
  isArray: isArray,
  isArrayBuffer: isArrayBuffer,
  isBuffer: isBuffer,
  isFormData: isFormData,
  isArrayBufferView: isArrayBufferView,
  isString: isString,
  isNumber: isNumber,
  isObject: isObject,
  isUndefined: isUndefined,
  isDate: isDate,
  isFile: isFile,
  isBlob: isBlob,
  isFunction: isFunction,
  isStream: isStream,
  isURLSearchParams: isURLSearchParams,
  isStandardBrowserEnv: isStandardBrowserEnv,
  forEach: forEach,
  merge: merge,
  extend: extend,
  trim: trim
};


/***/ }),

/***/ "./node_modules/axios/node_modules/is-buffer/index.js":
/*!************************************************************!*\
  !*** ./node_modules/axios/node_modules/is-buffer/index.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*!
 * Determine if an object is a Buffer
 *
 * @author   Feross Aboukhadijeh <https://feross.org>
 * @license  MIT
 */

module.exports = function isBuffer (obj) {
  return obj != null && obj.constructor != null &&
    typeof obj.constructor.isBuffer === 'function' && obj.constructor.isBuffer(obj)
}


/***/ }),

/***/ "./node_modules/process/browser.js":
/*!*****************************************!*\
  !*** ./node_modules/process/browser.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime.js":
/*!*****************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var runtime = (function (exports) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  exports.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  IteratorPrototype[iteratorSymbol] = function () {
    return this;
  };

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = Gp.constructor = GeneratorFunctionPrototype;
  GeneratorFunctionPrototype.constructor = GeneratorFunction;
  GeneratorFunctionPrototype[toStringTagSymbol] =
    GeneratorFunction.displayName = "GeneratorFunction";

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      prototype[method] = function(arg) {
        return this._invoke(method, arg);
      };
    });
  }

  exports.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  exports.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      if (!(toStringTagSymbol in genFun)) {
        genFun[toStringTagSymbol] = "GeneratorFunction";
      }
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  exports.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return Promise.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return Promise.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new Promise(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  AsyncIterator.prototype[asyncIteratorSymbol] = function () {
    return this;
  };
  exports.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  exports.async = function(innerFn, outerFn, self, tryLocsList) {
    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList)
    );

    return exports.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        // Note: ["return"] must be used for ES3 parsing compatibility.
        if (delegate.iterator["return"]) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  Gp[toStringTagSymbol] = "Generator";

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  Gp[iteratorSymbol] = function() {
    return this;
  };

  Gp.toString = function() {
    return "[object Generator]";
  };

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  exports.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  exports.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };

  // Regardless of whether this script is executing as a CommonJS module
  // or not, return the runtime object so that we can declare the variable
  // regeneratorRuntime in the outer scope, which allows this module to be
  // injected easily by `bin/regenerator --include-runtime script.js`.
  return exports;

}(
  // If this script is executing as a CommonJS module, use module.exports
  // as the regeneratorRuntime namespace. Otherwise create a new empty
  // object. Either way, the resulting object will be used to initialize
  // the regeneratorRuntime variable at the top of this file.
   true ? module.exports : undefined
));

try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  // This module should not be running in strict mode, so the above
  // assignment should always work unless something is misconfigured. Just
  // in case runtime.js accidentally runs in strict mode, we can escape
  // strict mode using a global Function call. This could conceivably fail
  // if a Content Security Policy forbids using Function, but in that case
  // the proper solution is to fix the accidental strict mode problem. If
  // you've misconfigured your bundler to force strict mode and applied a
  // CSP to forbid Function, and you're not willing to fix either of those
  // problems, please detail your unique predicament in a GitHub issue.
  Function("r", "regeneratorRuntime = r")(runtime);
}


/***/ }),

/***/ "./resources/js/components/AccordionList.js":
/*!**************************************************!*\
  !*** ./resources/js/components/AccordionList.js ***!
  \**************************************************/
/*! exports provided: accordionListFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "accordionListFactory", function() { return accordionListFactory; });
/* harmony import */ var _factories_ListFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/ListFactory */ "./resources/js/factories/ListFactory.js");
/* harmony import */ var _facades_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../facades/dom */ "./resources/js/facades/dom.js");



function AccordionList(options) {
  this.items = [];

  this.init = function () {
    this.items = this.el.getElementsByClassName('accordion-list__card');

    for (var i = 0; i < this.items.length; i++) {
      if (_facades_dom__WEBPACK_IMPORTED_MODULE_1__["default"].isElement(this.items[i]) || _facades_dom__WEBPACK_IMPORTED_MODULE_1__["default"].isNode(this.items[i])) {
        this.clampItem(this.items[i]);
      }
    }

    return this;
  };

  this.clampItem = function (item) {
    $clamp(this.getCardTitle(item), {
      clamp: 1
    });
    $clamp(this.getCardSubtitle(item), {
      clamp: 1
    });
    $clamp(this.getCardDescription(item), {
      clamp: 2
    });
  };

  this.getCardTitle = function (item) {
    if (item !== null) {
      return item.querySelector('.accordion-list__card-title');
    }

    return null;
  };

  this.getCardSubtitle = function (item) {
    if (item !== null) {
      return item.querySelector('.accordion-list__card-subtitle');
    }

    return null;
  };

  this.getCardDescription = function (item) {
    if (item !== null) {
      return item.querySelector('.accordion-list__card-description');
    }

    return null;
  };

  this.getParentCard = function (element) {
    return $(element).parents('.accordion-list__card')[0];
  };
}

var accordionListFactory = new _factories_ListFactory__WEBPACK_IMPORTED_MODULE_0__["ListFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (AccordionList);

/***/ }),

/***/ "./resources/js/components/ArrowSlider.js":
/*!************************************************!*\
  !*** ./resources/js/components/ArrowSlider.js ***!
  \************************************************/
/*! exports provided: arrowSliderFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "arrowSliderFactory", function() { return arrowSliderFactory; });
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");
/* harmony import */ var _main_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/dom */ "./resources/js/main/dom.js");
/* harmony import */ var _facades_browser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../facades/browser */ "./resources/js/facades/browser.js");
/* harmony import */ var _factories_SliderFactory__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../factories/SliderFactory */ "./resources/js/factories/SliderFactory.js");





function ArrowSlider(options) {
  var _this2 = this;

  this.holder = document.querySelector('.arrow-slider__holder');
  this.sliderKeys = options.sections !== undefined ? options.sections : null;
  this.offset = 1;
  this.currentSlideIndex = options.slide ? options.slide + this.offset : null;
  this.carousel = this.holder.children[0];
  this.slides = this.carousel.children;
  this.controllers = [];
  this.callbacks = options.callbacks ? options.callbacks : {}; // this.controllersCallback = options.controllersCallback ? options.controllersCallback : null;

  this.currentSlide = this.slides[this.currentSlideIndex - this.offset];

  this.init = function () {
    this.setControllers().setColors().setCurrentSlideIndex().setCurrentSlide(this.currentSlideIndex - this.offset).runAutoWidths().setResponsive();
    this.setListeners();
  };
  /**
   * Sets all the listeners.
   */


  this.setListeners = function () {
    var _this = this;

    window.addEventListener('resize', function () {
      _this.setResponsive(_this);
    });
  };
  /**
   * Sets an array of the colors used by each slide of the slider.
   *
   * @returns {ArrowSlider}
   */


  this.setColors = function () {
    this.colors = [];

    for (var i = 0; i < this.slides.length; i++) {
      this.colors.push(window.getComputedStyle(this.slides[i], ':before').getPropertyValue('background-color'));
    }

    return this;
  };
  /**
   * Sets the corresponding width for the given slide.
   *
   * @param slide
   * @returns {ArrowSlider}
   */


  this.autoWidth = function (slide) {
    /*
     * Gives the slide passed the same width as the holder has
     * so that each slide fit the width of the viewport.
     */
    $(slide).width(this.holder.clientWidth); // If is not a mobile device

    if (_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isLargeDevice()) {
      /*
       * If the slide passed is the current the user is interacting with
       * sets the proper class to the element.
       */
      if (this.isCurrentSlide(slide)) {
        $(slide).removeClass();
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(slide, 'arrow-slider__slide--current');
        /**
         * Additionally, checks if the current slide is the first or the last
         * as well, thus the text doesn't get centered.
         */

        if (this.isFirstSlide(slide)) {
          _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(slide, 'first');
        }

        if (this.isLastSlide(slide)) {
          _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(slide, 'last');
        }
      }
      /*
       * If the slide passed is the previous to the one the user
       * is interacting with, then sets the proper class to the element.
       */


      if (this.isPreviousSlide(slide)) {
        $(slide).removeClass();
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(slide, 'arrow-slider__slide--left');
      }
      /*
       * If the slide passed is the next to the one the user
       * is interacting with, then sets the proper class to the element.
       */


      if (this.isNextSlide(slide)) {
        $(slide).removeClass();
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(slide, 'arrow-slider__slide--right');
      }

      return this;
    }
    /**
     * Ultimately, sets the same class as used when the user
     * is using a mobile device.
     */


    $(slide).removeClass();
    _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(slide, 'arrow-slider__slide');
    return this;
  };

  this.isCurrentSlide = function (slide) {
    if (this.currentSlide !== undefined) {
      return slide.isEqualNode(this.currentSlide);
    }

    return false;
  };

  this.isNextSlide = function (slide) {
    if (this.slides[this.currentSlideIndex] !== undefined) {
      return slide.isEqualNode(this.slides[this.currentSlideIndex]);
    }

    return false;
  };

  this.getNextSlide = function () {
    if (this.slides[this.currentSlideIndex] !== undefined) {
      return this.slides[this.currentSlideIndex];
    }

    return null;
  };

  this.getCurrentSlide = function () {
    if (this.slides[this.currentSlideIndex - this.offset] !== undefined) {
      return this.slides[this.currentSlideIndex - this.offset];
    }

    return null;
  };

  this.getPreviousSlide = function () {
    if (this.slides[this.currentSlideIndex - this.offset * 2] !== undefined) {
      return this.slides[this.currentSlideIndex - this.offset * 2];
    }

    return null;
  };

  this.isPreviousSlide = function (slide) {
    if (this.slides[this.currentSlideIndex - this.offset * 2] !== undefined) {
      return slide.isEqualNode(this.slides[this.currentSlideIndex - this.offset * 2]);
    }

    return false;
  };

  this.isFirstSlide = function (slide) {
    return slide.isEqualNode(this.slides[0]);
  };

  this.isLastSlide = function (slide) {
    return slide.isEqualNode(this.slides[this.slides.length - this.offset]);
  };

  this.setCurrentSlide = function (value) {
    this.currentSlide = this.slides[value];
    return this;
  };

  this.isSlide = function (element) {
    return $.inArray('arrow-slider__slide--left', element.classList) > -1 || $.inArray('arrow-slider__slide--current', element.classList) > -1 || $.inArray('arrow-slider__slide--right', element.classList) > -1 || $.inArray('arrow-slider__slide', element.classList) > -1;
  };

  this.isController = function (element) {
    var isController = null;
    $('.arrow-slider__controllers').children().each(function (key, controller) {
      if (controller.isEqualNode(element)) {
        isController = true;
      }
    });
    return isController;
  };

  this.setCurrentSlideIndex = function () {
    var value = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

    if (value === null) {
      for (var i = 0; i < this.controllers.length; i++) {
        if ($(this.controllers[i]).hasClass('selected')) {
          this.currentSlideIndex = i + this.offset;
          return this;
        }
      }
    }

    this.currentSlideIndex = value + this.offset;
    return this;
  };

  this.setSliderId = function () {
    this.holder.setAttribute('id', this.sliderKeys[this.currentSlideIndex - this.offset]); //browser.verticalScrollTo(this.holder);

    return this;
  };
  /**
   * Sets the width of all the slides comprised in the slider.
   *
   * @returns {ArrowSlider}
   */


  this.runAutoWidths = function () {
    for (var i = 0; i < this.slides.length; i++) {
      this.autoWidth(this.slides[i]);
    }

    ;
    return this;
  };
  /**
   * Makes the proper settings to fit the slider according
   * to the browser's viewport.
   *
   * @param self
   */


  this.setResponsive = function () {
    var self = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this;
    self.setControllers(); // Sets the slider holder width.

    $(self.carousel).width(self.holder.clientWidth * self.slides.length);
    self.runAutoWidths().moveCarousel().paint();
  };

  this.isLightColor = function (color) {
    var lightColorsCounter = 0;

    for (var i = 0; i < 'rgb'.length; i++) {
      if (parseInt(color.match(/[0-9]{1,3}/g)[i]) > 150) {
        lightColorsCounter++;
      }
    }

    return lightColorsCounter >= 2;
  };
  /**
   * Sets the corresponding colour of the current slide and its controllers.
   *
   * @returns {ArrowSlider}
   */


  this.paint = function () {
    // Change carousel background to the proper color given
    this.carousel.style.background = this.colors[this.currentSlideIndex - this.offset];
    var controllersContainer = this.controllers[this.currentSlideIndex - this.offset].parentElement;

    if (this.isLightColor(this.carousel.style.backgroundColor)) {
      if (!$(controllersContainer).hasClass('dark')) {
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(controllersContainer, 'dark');
      }

      return this;
    }

    if ($(controllersContainer).hasClass('dark')) {
      _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(controllersContainer, 'dark');
    }

    return this;
  };
  /**
   * Slide the slider toward the one selected by the user.
   *
   * @returns {ArrowSlider}
   */


  this.moveCarousel = function () {
    var posX = this.holder.clientWidth * (this.currentSlideIndex - this.offset);
    $(this.carousel).css({
      "-webkit-transform": "translateX(-" + posX + "px)",
      "transform": "translateX(-" + posX + "px)",
      "-ms-transform": "translateX(-" + posX + "px)",
      "-o-transform": "translateX(-" + posX + "px)"
    });
    return this;
  };
  /**
   * Updates the slider controllers according to the slide selected by the user.
   * (e.g. If the user selects the second slide, then the controller bound to that
   * slide gets marked and the next and previous slide change).
   *
   * @param e
   */


  this.updateController = function (e) {
    e.stopPropagation();
    var controller = e.target;

    while (!_this2.isSlide(controller) && !_this2.isController(controller)) {
      controller = controller.parentElement;
    }

    for (var x = 0; x < _this2.controllers.length; x++) {
      if (controller.isEqualNode(_this2.controllers[x])) {
        if (_this2.currentSlideIndex !== x + _this2.offset) {
          // Update controllers.
          _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(_this2.controllers[_this2.currentSlideIndex - _this2.offset], 'selected');

          if (x >= _this2.slides.length) {
            var slideSelected = _this2.isNextSlide(_this2.controllers[x]) === true ? _this2.currentSlideIndex : _this2.currentSlideIndex - _this2.offset * 2;

            _this2.setCurrentSlide(slideSelected).setCurrentSlideIndex(slideSelected);
          } else {
            e.preventDefault();

            _this2.setCurrentSlideIndex(x).setCurrentSlide(x);
          }

          _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(_this2.controllers[_this2.currentSlideIndex - _this2.offset], 'selected'); // Update the sliders.

          _this2.setSliderId().runAutoWidths().moveCarousel().paint();

          if (_this2.callbacks.controllers !== undefined) {
            _this2.callbacks.controllers(_this2.currentSlide);
          }

          _this2.setControllers();
        }
      }
    }
  };
  /**
   * Attaches the events bound to the slider controllers.
   */


  this.setControllersListeners = function () {
    for (var i = 0; i < this.controllers.length; i++) {
      this.controllers[i].removeEventListener('click', this.updateController);
      this.controllers[i].addEventListener('click', this.updateController);

      if (this.isSlide(this.controllers[i])) {
        $(this.controllers[i]).on('click', '*', this.updateController);
      }
    }
  };
  /**
   * Restart all the controllers of the slider.
   *
   * @return {ArrowSlider}
   */


  this.resetControllers = function () {
    if (this.slides.length < this.controllers.length) {
      for (var i = this.slides.length; i < this.controllers.length; i++) {
        this.controllers.pop();
      }
    }

    return this;
  };
  /**
   * Set the controllers of the slider and attaches their corresponding events.
   *
   * @returns {ArrowSlider}
   */


  this.setControllers = function () {
    if (!this.controllers.length > 0) {
      var controllers = document.querySelector('.arrow-slider__controllers').children;

      for (var i = 0; i < controllers.length; i++) {
        this.controllers.push(controllers[i]);
      }
    }

    if (this.currentSlideIndex !== null) {
      this.resetControllers();

      if (_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isLargeDevice()) {
        if (!this.isFirstSlide(this.slides[this.currentSlideIndex - this.offset]) && !this.isLastSlide(this.slides[this.currentSlideIndex - this.offset])) {
          this.controllers.push(this.getNextSlide());
          this.controllers.push(this.getPreviousSlide());
        } else {
          this.controllers.push(this.isFirstSlide(this.slides[this.currentSlideIndex - this.offset]) ? this.getNextSlide() : this.getPreviousSlide());
        }
      }

      this.setControllersListeners();
    }

    return this;
  };

  this.init();
}

;
var arrowSliderFactory = new _factories_SliderFactory__WEBPACK_IMPORTED_MODULE_3__["SliderFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (ArrowSlider);

/***/ }),

/***/ "./resources/js/components/BottomNavigation.js":
/*!*****************************************************!*\
  !*** ./resources/js/components/BottomNavigation.js ***!
  \*****************************************************/
/*! exports provided: bottomNavigationFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "bottomNavigationFactory", function() { return bottomNavigationFactory; });
/* harmony import */ var _factories_NavigationFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/NavigationFactory */ "./resources/js/factories/NavigationFactory.js");
/* harmony import */ var _facades_browser__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../facades/browser */ "./resources/js/facades/browser.js");



function BottomNavigation(options) {
  this.position = {};
  this.viewport = null;

  this.init = function () {
    var _this = this;

    this.setViewport().setPosition().toggle();
    window.addEventListener('resize', function (ev) {
      _this.setViewport().setPosition().toggle();
    });
    window.addEventListener('scroll', function (ev) {
      _this.setViewport().toggle(ev);
    });
  };

  this.setViewport = function () {
    this.viewport = window.innerWidth;
    return this;
  };

  this.setPosition = function () {
    var previousElement = $(this.el).prev();

    if (previousElement !== null || previousElement.length === 0) {
      this.position.top = $(previousElement).offset().top + $(previousElement).height();
      this.position.bottom = this.position.top + this.el.clientHeight;
    }

    return this;
  };

  this.isFixed = function () {
    return $(this.el).hasClass('bottom-navigation--fixed');
  };

  this.scrollTo = function (position) {
    _facades_browser__WEBPACK_IMPORTED_MODULE_1__["default"].scrollSmoothlyTo('top', position);
  };

  this.toggle = function () {
    var ev = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    this.setPosition();

    if (_facades_browser__WEBPACK_IMPORTED_MODULE_1__["default"].isElementScoped(this.position)) {
      if (this.isFixed()) {
        $(this.el).removeClass('bottom-navigation--fixed');
      }

      return this;
    }

    if (!this.isFixed()) {
      $(this.el).addClass('bottom-navigation--fixed');
    }

    return this;
  };
}

var bottomNavigationFactory = new _factories_NavigationFactory__WEBPACK_IMPORTED_MODULE_0__["NavigationFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (BottomNavigation);

/***/ }),

/***/ "./resources/js/components/Counter.js":
/*!********************************************!*\
  !*** ./resources/js/components/Counter.js ***!
  \********************************************/
/*! exports provided: default, counterFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "counterFactory", function() { return counterFactory; });
/* harmony import */ var _factories_CounterFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/CounterFactory */ "./resources/js/factories/CounterFactory.js");


function Counter(options) {
  this.items = [];

  this.init = function () {
    this.items = this.container.getElementsByClassName('stats__item');
    this.setCounters();
  };

  this.setCounters = function () {
    for (var i = 0; i < this.items.length; i++) {
      this.count(this.items[i]);
    }
  };

  this.count = function (item) {
    var counter = item.querySelector('.stats__item-counter');
    $(counter).prop('Counter', 0).animate({
      Counter: $(counter).text()
    }, {
      duration: 4000,
      easing: 'swing',
      step: function step(now) {
        $(this).text(Math.ceil(now));
      }
    });
  };
}

/* harmony default export */ __webpack_exports__["default"] = (Counter);
var counterFactory = new _factories_CounterFactory__WEBPACK_IMPORTED_MODULE_0__["CounterFactory"]();

/***/ }),

/***/ "./resources/js/components/Dialog.js":
/*!*******************************************!*\
  !*** ./resources/js/components/Dialog.js ***!
  \*******************************************/
/*! exports provided: dialogFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "dialogFactory", function() { return dialogFactory; });
/* harmony import */ var _factories_DialogsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/DialogsFactory */ "./resources/js/factories/DialogsFactory.js");


function Dialog(options) {
  this.el = document.getElementById('dialog-box');
  this.container = this.el.children[0];
  /**
   * Replace the dialog by the HTML content passed as
   * an argument.
   *
   * @param content
   */

  this.replace = function (content) {
    var header = this.el.parentElement;
    $(this.el).remove();
    $(header).append(content);
    return dialogFactory.createDialog();
  };
}

var dialogFactory = new _factories_DialogsFactory__WEBPACK_IMPORTED_MODULE_0__["DialogFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (Dialog);

/***/ }),

/***/ "./resources/js/components/FlexTable.js":
/*!**********************************************!*\
  !*** ./resources/js/components/FlexTable.js ***!
  \**********************************************/
/*! exports provided: flexTableFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "flexTableFactory", function() { return flexTableFactory; });
/* harmony import */ var _factories_TableFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/TableFactory */ "./resources/js/factories/TableFactory.js");
/* harmony import */ var _facades_str__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../facades/str */ "./resources/js/facades/str.js");



function FlexTable(options) {
  this.headers = null;

  this.init = function () {
    var _this = this;

    this.headers = $(this.el).find('thead > tr > th');

    var _loop = function _loop(i) {
      var column = _facades_str__WEBPACK_IMPORTED_MODULE_1__["default"].camelCase(_this.headers[i].getAttribute('data-value'));

      _this['row' + column.charAt(0).toUpperCase() + column.substr(1)] = function (element) {
        return $(_this.row(element)).children('td[data-label=' + _facades_str__WEBPACK_IMPORTED_MODULE_1__["default"].titleCase(column) + ']')[0];
      };
    };

    for (var i = 0; i < this.headers.length; i++) {
      _loop(i);
    }

    return this;
  };

  this.row = function (element) {
    return $(element).parents('.flex-table__item-content')[0];
  };
}

var flexTableFactory = new _factories_TableFactory__WEBPACK_IMPORTED_MODULE_0__["TableFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (FlexTable);

/***/ }),

/***/ "./resources/js/components/Infography.js":
/*!***********************************************!*\
  !*** ./resources/js/components/Infography.js ***!
  \***********************************************/
/*! exports provided: infographyFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "infographyFactory", function() { return infographyFactory; });
/* harmony import */ var _factories_InfographyFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/InfographyFactory */ "./resources/js/factories/InfographyFactory.js");
/* harmony import */ var _facades_browser__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../facades/browser */ "./resources/js/facades/browser.js");



function Infography(options) {
  this.items = [];

  this.init = function () {
    var _this = this;

    this.items = this.el.getElementsByClassName('step-list__item');
    window.addEventListener('load', function (ev) {
      _this.showItems(ev);
    });
    window.addEventListener('scroll', function (ev) {
      _this.showItems(ev);
    });
    window.addEventListener('resize', function (ev) {
      _this.showItems(ev);
    });
  };

  this.showItems = function (ev) {
    for (var i = 0; i < this.items.length; i++) {
      if (!$(this.items[i]).hasClass('show') && _facades_browser__WEBPACK_IMPORTED_MODULE_1__["default"].isElementScoped(this.items[i])) {
        $(this.items[i]).addClass('show');
      }
    }

    ;
  };
}

var infographyFactory = new _factories_InfographyFactory__WEBPACK_IMPORTED_MODULE_0__["InfographyFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (Infography);

/***/ }),

/***/ "./resources/js/components/MediaCards.js":
/*!***********************************************!*\
  !*** ./resources/js/components/MediaCards.js ***!
  \***********************************************/
/*! exports provided: mediaCardFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mediaCardFactory", function() { return mediaCardFactory; });
/* harmony import */ var _factories_CardsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/CardsFactory */ "./resources/js/factories/CardsFactory.js");


function MediaCard(options) {
  this.items = [];

  this.init = function () {
    this.items = this.el.getElementsByClassName('media-card__card');
    return this;
  };

  this.getCard = function (key) {
    return this.items[key];
  };

  this.getParentItem = function (element) {
    return $(element).parents('.media-card__list-item')[0];
  };

  this.getCardTitle = function (item) {
    if (item !== null) {
      return item.querySelector('.media-card__heading');
    }

    return null;
  };
}

var mediaCardFactory = new _factories_CardsFactory__WEBPACK_IMPORTED_MODULE_0__["CardsFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (MediaCard);

/***/ }),

/***/ "./resources/js/components/MediaSlider.js":
/*!************************************************!*\
  !*** ./resources/js/components/MediaSlider.js ***!
  \************************************************/
/*! exports provided: mediaSliderFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mediaSliderFactory", function() { return mediaSliderFactory; });
/* harmony import */ var _factories_SliderFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/SliderFactory */ "./resources/js/factories/SliderFactory.js");


function MediaSlider(options) {
  this.holder = document.querySelector('.media-slider__holder');
  this.offset = 1;
  this.currentSlideIndex = null;
  this.carousel = this.holder.children[0];
  this.slides = this.carousel.children;
  this.controllers = document.querySelector('.media-slider__controllers').children;
  this.currentSlide = this.slides[0];

  this.init = function () {
    this.setControllersListeners().setCurrentSlideIndex().setCurrentSlide(this.currentSlideIndex).setWidths().setHolder();
    this.listeners();
  };
  /**
   * Sets the slider holder height to the same value as the
   * highest slide of the slider.
   */


  this.setHolder = function () {
    this.holder.style.height = this.getSlidesHeight();
  };
  /**
   * Sets all the listeners of the slider.
   */


  this.listeners = function () {
    var _this = this;

    window.addEventListener('resize', function () {
      _this.update(_this);
    });
  };
  /**
   * Makes the proper settings to fit the slider according
   * to the browser's viewport.
   *
   * @returns {MediaSlider}
   */


  this.setWidths = function () {
    this.carousel.style.width = $(this.holder).width() * this.slides.length + 'px';
    $(this.slides).width(this.holder.clientWidth);
    return this;
  };

  this.setCurrentSlideIndex = function () {
    var value = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

    if (value == null) {
      this.currentSlideIndex = 0;
      return this;
    }

    this.currentSlideIndex = value;
    return this;
  };
  /**
   * Updates the slider controllers according to the slide selected by the user..
   *
   * @param self
   */


  this.update = function () {
    var self = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this;
    self.setWidths().moveCarousel();
    return this;
  };

  this.setCurrentSlide = function (value) {
    this.currentSlide = this.slides[value];
    return this;
  };

  this.setControllersListeners = function () {
    var _this2 = this;

    var _loop = function _loop(i) {
      _this2.controllers[i].children[0].addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        _this2.preventScrolling().setCurrentSlideIndex(i + _this2.offset).setCurrentSlide(_this2.setCurrentSlideIndex).moveCarousel();
      });
    };

    for (var i = 0; i < this.controllers.length; i++) {
      _loop(i);
    }

    return this;
  };

  this.getSlidesWidth = function () {
    return $(this.slides[0]).width();
  };

  this.getSlidesHeight = function () {
    return this.slides[0].offsetHeight;
  };

  this.preventScrolling = function () {
    window.scrollBy(0, 0);
    return this;
  };
  /**
   * Slide the slider toward the one selected by the user.
   *
   * @returns {ArrowSlider}
   */


  this.moveCarousel = function () {
    $(this.carousel).css({
      "-webkit-transform": "translateX(-" + this.holder.clientWidth * this.currentSlideIndex + "px)",
      "transform": "translateX(-" + this.holder.clientWidth * this.currentSlideIndex + "px)",
      "-ms-transform": "translateX(-" + this.holder.clientWidth * this.currentSlideIndex + "px)",
      "-o-transform": "translateX(-" + this.holder.clientWidth * this.currentSlideIndex + "px)"
    });
    return this;
  };

  this.init();
}

var mediaSliderFactory = new _factories_SliderFactory__WEBPACK_IMPORTED_MODULE_0__["SliderFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (MediaSlider);

/***/ }),

/***/ "./resources/js/components/Modal.js":
/*!******************************************!*\
  !*** ./resources/js/components/Modal.js ***!
  \******************************************/
/*! exports provided: modalsFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "modalsFactory", function() { return modalsFactory; });
/* harmony import */ var _factories_ModalsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/ModalsFactory */ "./resources/js/factories/ModalsFactory.js");


function Modal(options) {
  this.el = options.el;
  this.autofocus = options.autofocus ? options.autofocus : false;

  this.init = function () {
    var _this = this;

    $(this.el).on('shown.bs.modal', function (event) {
      return _this.setAutofocus(event);
    });
    return this;
  };

  this.setAutofocus = function (event) {
    if (this.autofocus) {
      $(this.el).find(".modal-body :input:not([type=hidden])")[0].focus();
    }

    return this;
  };

  this.getAllTriggerElements = function () {
    return $('[data-target="#' + this.el.getAttribute('id') + '"]');
  };

  this.setModalTitle = function (title) {
    this.el.querySelector('.modal-title').innerText = title;
  };

  this.init();
}

var modalsFactory = new _factories_ModalsFactory__WEBPACK_IMPORTED_MODULE_0__["ModalFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (Modal);

/***/ }),

/***/ "./resources/js/components/PeopleSlider.js":
/*!*************************************************!*\
  !*** ./resources/js/components/PeopleSlider.js ***!
  \*************************************************/
/*! exports provided: peopleSliderFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "peopleSliderFactory", function() { return peopleSliderFactory; });
/* harmony import */ var _factories_SliderFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/SliderFactory */ "./resources/js/factories/SliderFactory.js");
/* harmony import */ var _main_UI__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/UI */ "./resources/js/main/UI.js");



function PeopleSlider(options) {
  this.holder = document.querySelector('.people-slider__holder');
  this.offset = 1;
  this.interval = options.interval;
  this.duration = options.duration;
  this.currentSlideIndex = options.slide ? options.slide + this.offset : 1;
  this.carousel = this.holder.children[0];
  this.slides = this.carousel.children;
  this.currentSlide = this.currentSlide = this.slides[this.currentSlideIndex - this.offset];

  this.init = function () {
    var _this = this;

    //setInterval(this.renew, this.interval);
    setInterval(function () {
      _this.renew(_this);
    }, this.interval);
  };

  this.setCurrentSlide = function (value) {
    this.currentSlide = this.slides[value - this.offset];
    return this;
  };

  this.setCurrentSlideIndex = function () {
    var value = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    this.currentSlideIndex = value;
    return this;
  };

  this.isCurrentSlideIndex = function (value) {
    return value === this.currentSlideIndex;
  };

  this.renew = function () {
    var self = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this;
    var randomSlideIndex = Math.floor(Math.random() * this.slides.length) + this.offset;

    if (!this.isCurrentSlideIndex(randomSlideIndex)) {
      self.setCurrentSlideIndex(randomSlideIndex).setCurrentSlide(this.currentSlideIndex).moveCarousel().fade('out').fade('in');
    }
  };

  this.fade = function (type) {
    var fn = 'fade' + _main_UI__WEBPACK_IMPORTED_MODULE_1__["default"].upperCaseFirst(type);
    $(this.carousel)[fn]({
      duration: this.duration,
      easing: 'swing'
    });
    return this;
  };

  this.moveCarousel = function () {
    var posY = this.holder.clientHeight * (this.currentSlideIndex - this.offset);
    $(this.carousel).css({
      "-webkit-transform": "translateY(-" + posY + "px)",
      "transform": "translateY(-" + posY + "px)",
      "-ms-transform": "translateY(-" + posY + "px)",
      "-o-transform": "translateY(-" + posY + "px)"
    });
    return this;
  };

  this.init();
}

var peopleSliderFactory = new _factories_SliderFactory__WEBPACK_IMPORTED_MODULE_0__["SliderFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (PeopleSlider);

/***/ }),

/***/ "./resources/js/components/SquareGrid.js":
/*!***********************************************!*\
  !*** ./resources/js/components/SquareGrid.js ***!
  \***********************************************/
/*! exports provided: squareGridFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "squareGridFactory", function() { return squareGridFactory; });
/* harmony import */ var _factories_GridsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../factories/GridsFactory */ "./resources/js/factories/GridsFactory.js");
/* harmony import */ var _facades_browser__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../facades/browser */ "./resources/js/facades/browser.js");



function SquareGrid(options) {
  this.items = [];
  this.highest = null;

  this.init = function () {
    var _this = this;

    this.items = this.el.getElementsByClassName('square-grid__square');

    for (var i = 0; i < this.items.length; i++) {
      if (this.highest == null) {
        this.highest = this.items[i];
      }

      this.highest = this.items[i].clientHeight > this.highest.clientHeight ? this.items[i] : this.highest;
    }

    this.levelItems();
    window.addEventListener('resize', function (ev) {
      _this.levelItems();
    });
  };

  this.levelItems = function () {
    var unit = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'px';

    for (var i = 0; i < this.items.length; i++) {
      if (!this.highest.isEqualNode(this.items[i])) {
        this.items[i].style.height = _facades_browser__WEBPACK_IMPORTED_MODULE_1__["default"].isBootstrapBreakpoint('sm') ? this.highest.clientHeight + unit : '';
      }
    }
  };
}

var squareGridFactory = new _factories_GridsFactory__WEBPACK_IMPORTED_MODULE_0__["GridFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (SquareGrid);

/***/ }),

/***/ "./resources/js/components/_edit-offer.js":
/*!************************************************!*\
  !*** ./resources/js/components/_edit-offer.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var editOffer = {
  init: function init() {
    editOffer.setup();
  },
  form: document.querySelector('#editOffer') !== null ? document.querySelector('#editOffer') : null,
  setup: function setup() {
    window.addEventListener('load', function (event) {
      editOffer.loadWYSIWYGEditor();
    });
    editOffer.inputPicture.addEventListener('change', function (event) {
      editOffer.picturePreview(this, $(this).siblings('.img-preview'));
    });
  },
  inputPicture: document.getElementById('picture') !== null ? document.getElementById('picture') : null,
  loadWYSIWYGEditor: function loadWYSIWYGEditor() {
    if (document.querySelector('.items_form') !== null || document.querySelector('.items_form--hidden')) {
      var editor = new Quill('.editor', {
        modules: {
          toolbar: [[{
            header: [4, 5, false]
          }], ['bold', 'italic', 'underline'], [{
            'list': 'ordered'
          }, {
            'list': 'bullet'
          }, 'blockquote'], [{
            'indent': '-1'
          }, {
            'indent': '+1'
          }, 'link', 'code-block']]
        },
        placeholder: 'Write down the job description...',
        theme: 'snow'
      });
    }

    var delta = document.querySelector('.editor').getAttribute('data-html');
    editOffer.setDeltaToEditor(delta, editor);
    editOffer.form.addEventListener('submit', function () {
      var description = document.querySelector('input[name=description]');
      description.value = JSON.stringify(editor.getContents());
    });
  },
  setDeltaToEditor: function setDeltaToEditor(delta, editor) {
    editor.setContents(JSON.parse(delta));
  },
  picturePreview: function picturePreview(input, imgElement) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.addEventListener('load', function (e) {
        $(imgElement).attr('src', e.target.result);
      });
      reader.readAsDataURL(input.files[0]);
    }
  }
};

if (document.querySelector('#editOffer') !== null) {
  editOffer.init();
}

/***/ }),

/***/ "./resources/js/components/_footer.js":
/*!********************************************!*\
  !*** ./resources/js/components/_footer.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _forms_ContactForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./forms/ContactForm */ "./resources/js/components/forms/ContactForm.js");
/* harmony import */ var _facades_browser__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../facades/browser */ "./resources/js/facades/browser.js");



var footer = function () {
  var el = document.querySelector('.footer');
  var contactForm = null;

  var init = function init() {
    setListeners();
  };

  var setContactForm = function setContactForm() {
    contactForm = new _forms_ContactForm__WEBPACK_IMPORTED_MODULE_0__["contactFormFactory"].createForm({
      type: 'contact',
      form: el.querySelector('.contact-form')
    });

    if (contactForm.hasErrorMessages()) {
      contactForm.focusFirstInvalidField();
      window.scrollBy(0, contactForm.el.getBoundingClientRect().top);
    }

    ;
  };

  var setResponsiveness = function setResponsiveness() {
    if (_facades_browser__WEBPACK_IMPORTED_MODULE_1__["default"].matchesGivenBreakpoint('footer.checkbox') && contactForm.fields.terms.classList.contains('c-switch-input') || !_facades_browser__WEBPACK_IMPORTED_MODULE_1__["default"].matchesGivenBreakpoint('footer.checkbox') && contactForm.fields.terms.classList.contains('c-checkbox-input')) {
      contactForm.toggleCheckableInput();
    }
  };

  var setListeners = function setListeners() {
    if (el !== null) {
      window.addEventListener('load', function (e) {
        setContactForm();
        setResponsiveness();
      });
      window.addEventListener('resize', function (e) {
        setResponsiveness();
      });
    }
  };

  init();
}();

/***/ }),

/***/ "./resources/js/components/_offers-list.js":
/*!*************************************************!*\
  !*** ./resources/js/components/_offers-list.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_messages__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/messages */ "./resources/js/main/messages.js");
/* harmony import */ var _facades_pagination__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../facades/pagination */ "./resources/js/facades/pagination.js");
/* harmony import */ var _facades_api_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../facades/api.js */ "./resources/js/facades/api.js");
/* harmony import */ var _filters_IndustryFilter__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./filters/IndustryFilter */ "./resources/js/components/filters/IndustryFilter.js");





var offersList = function () {
  var el = document.getElementById('job-board');
  var industryFilter = null;

  var init = function init() {
    setPagination();
    setIndustryFilter();
  };

  var setPagination = function setPagination() {
    if (_facades_pagination__WEBPACK_IMPORTED_MODULE_1__["default"].hasPagination()) {
      _facades_pagination__WEBPACK_IMPORTED_MODULE_1__["default"].paginate({
        container: document.querySelector('.items-pagination')
      });
    }
  };

  var setIndustryFilter = function setIndustryFilter() {
    if (document.getElementById('industryFilter') !== null) {
      industryFilter = new _filters_IndustryFilter__WEBPACK_IMPORTED_MODULE_3__["industryFilterFactory"].createFilter({
        type: 'industry',
        filter: document.getElementById('industryFilter'),
        callback: function callback(data) {
          $(el.querySelector('#content')).find('.cards-list').remove();
          $(el.querySelector('#content')).append(data);
        }
      });
    }

    ;
  };

  init();
}(); // let offersList = {
//     init: () => {
//         window.addEventListener('load', offersList.setup);
//
//         // if (pagination.hasPagination()) {
//         //     pagination.paginate({
//         //         container: document.querySelector('.items-pagination')
//         //     });
//         // }
//     },
//     inputFilter: document.querySelector('#inputFilter') !== null ? document.querySelector('#inputFilter') : null,
//     modalOffer: document.querySelector('#modalOffer') !== null ? document.querySelector('#modalOffer') : null,
//     deleteButtons: document.querySelectorAll('.delete') !== null ? document.querySelectorAll('.delete') : null,
//     setup: function() {
//         offersList.inputFilter.addEventListener('change', function(event) {
//             let selectedFilter = offersList.inputFilter.value;
//
//             api.jQueryGet(api.getRoute('offers'), null, [selectedFilter], function(data) {
//                 $('#content').html(data);
//                 offersList.init()
//             });
//         });
//
//         for (let i = 0; i < offersList.deleteButtons.length; i++) {
//             offersList.deleteButtons[i].addEventListener('click', function() {
//                 offersList.loadModalData(this);
//             })
//         }
//     },
//     render: (parentElement, data) => {
//         parentElement.innerHTML = data;
//     },
//     addRemoveFunction: (arr) => {
//         (function (arr) {
//             arr.forEach(function (item) {
//                 if (item.hasOwnProperty('remove')) {
//                     return;
//                 }
//                 Object.defineProperty(item, 'remove', {
//                     configurable: true,
//                     enumerable: true,
//                     writable: true,
//                     value: function remove() {
//                         if (this.parentNode !== null)
//                             this.parentNode.removeChild(this);
//                     }
//                 });
//             });
//         })([Element.prototype, CharacterData.prototype, DocumentType.prototype]);
//     },
//     loadModalData: function(element) {
//         let chosenOffer = element.getAttribute('data-value');
//         let modalForm = document.querySelector('#removeOffer');
//         modalForm.setAttribute('action', modalForm.getAttribute('action').replace(/[0-9]+$/, chosenOffer));
//         let offerTitle = $(element).parent().parent().siblings('.card-title').text();
//         document.querySelector('.modal-body__text').innerHTML = messages.form.advices.removeOffer(offerTitle);
//     }
// };
// if (document.querySelector('#job-board') !== null) {
//     offersList.init();
// }

/***/ }),

/***/ "./resources/js/components/_offers.js":
/*!********************************************!*\
  !*** ./resources/js/components/_offers.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var offers = {
  form: document.querySelector('.form') !== null ? document.querySelector('.form') : null,
  duration: {
    max: 24,
    min: 1
  },
  init: function init() {
    window.addEventListener('load', function (event) {
      offers.setup(event);
    });
  },
  setup: function setup(event) {
    if (document.querySelector('.items_form') !== null || document.querySelector('.items_form--hidden')) {
      var editor = new Quill('.editor', {
        modules: {
          toolbar: [[{
            header: [4, 5, false]
          }], ['bold', 'italic', 'underline'], [{
            'list': 'ordered'
          }, {
            'list': 'bullet'
          }, 'blockquote'], [{
            'indent': '-1'
          }, {
            'indent': '+1'
          }, 'link', 'code-block']]
        },
        placeholder: 'Write down the job description...',
        theme: 'snow'
      });
    }

    if (offers.form !== null) {
      offers.form.addEventListener('submit', function () {
        var description = document.querySelector('input[name=description]');
        description.value = JSON.stringify(editor.getContents());
      });

      offers.form.querySelector('input[name=duration').onkeypress = function (event) {
        if (!offers.validateKeyPressed(event.key)) {
          event.preventDefault();
        }
      };

      offers.form.querySelector('input[name=duration').onchange = function (event) {
        this.value = offers.validateDuration(this.value);
      };
    }
  },
  validateKeyPressed: function validateKeyPressed(key) {
    return Number.isInteger(parseInt(key));
  },
  validateDuration: function validateDuration(value) {
    if (!(parseInt(value) > offers.duration['min']) || !(parseInt(value) <= offers.duration['max'])) {
      if (parseInt(value) > offers.duration['max']) {
        return offers.duration['max'];
      }

      return offers.duration['min'];
    }

    return value;
  }
}; // Component Events

if (document.querySelector('.dropdown-button')) {
  //document.querySelector('.dropdown-button')..addEventListener('click', displayForm);
  var dropdownButtons = document.querySelectorAll('.dropdown-button');

  for (var i = 0; i < dropdownButtons.length; i++) {
    dropdownButtons[i].addEventListener('click', displayForm);
  }
} // Component Methods


function displayForm(event) {
  event.preventDefault();
  var formIsDisplayed = $('.items_form').length;

  if (!formIsDisplayed) {
    $('.items_form--hidden').addClass('items_form').removeClass('items_form--hidden');
    /*
     * Save the Y axis of the bottom of the previous element placed just
     * above the form that is going to be displayed.
     */

    var previousElementPosition = document.querySelector('.offers').offsetTop + document.querySelector('.offers').clientHeight; // Scrolls the page where the form is being displayed.

    slideTo('scrollDown', previousElementPosition); // Heads the typing to the first field of the hidden form

    var firstInputOfTheForm = $('.form_body input').filter(':first');
    firstInputOfTheForm.focus();
  }

  if (formIsDisplayed) {
    var itemManagementPosition = document.querySelector('.items_management').offsetTop;
    slideTo('scrollTop', itemManagementPosition);
    setTimeout(function () {
      $('.items_form').addClass('items_form--hidden').removeClass('items_form');
    }, 500);
  }
}

function slideTo(direction, target) {
  $("html, body").animate({
    direction: target
  }, 1000, 'swing');
}

if (document.querySelector('.offers') !== null) {
  offers.init();
}

/***/ }),

/***/ "./resources/js/components/_welcome-card.js":
/*!**************************************************!*\
  !*** ./resources/js/components/_welcome-card.js ***!
  \**************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _main_Forms__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/Forms */ "./resources/js/main/Forms.js");
/* harmony import */ var _main_Money__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../main/Money */ "./resources/js/main/Money.js");
/* harmony import */ var _main_UI__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../main/UI */ "./resources/js/main/UI.js");
/* harmony import */ var _main_domObserver_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../main/domObserver.js */ "./resources/js/main/domObserver.js");
/* harmony import */ var _main_api__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../main/api */ "./resources/js/main/api.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

var axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");






var welcomeCard = {
  init: function init() {
    window.addEventListener('DOMContentLoaded', function () {
      Object(_main_domObserver_js__WEBPACK_IMPORTED_MODULE_4__["default"])(welcomeCard.dialogBoxContainer().parentElement, welcomeCard.update);
    });
    welcomeCard.setup();
  },
  dialogBoxContainer: function dialogBoxContainer() {
    return document.querySelector('#dialog-box') ? document.querySelector('#dialog-box') : null;
  },
  update: function update() {
    welcomeCard.setup();
  },
  buttons: {
    "continue": {
      el: function el() {
        return document.querySelector('#continue') ? document.querySelector('#continue') : null;
      }
    }
  },
  forms: {
    payment: {
      el: function el() {
        return document.querySelector('#payment') ? document.querySelector('#payment') : null;
      }
    },
    checkout: {
      el: function el() {
        return document.querySelector('#checkout') ? document.querySelector('#checkout') : null;
      }
    }
  },
  elements: {
    header: function header() {
      return document.querySelector('#welcome') ? document.querySelector('#welcome') : null;
    },
    stripe: null
  },
  rates: null,
  paymentAmount: null,
  minimumHours: null,
  minimumStaying: null,
  getPricePerUnit: function getPricePerUnit() {
    return document.querySelector('#checkout-button-sku_GDHDkOPWtjGF2w').querySelector('span').getAttribute('data-value') / 100;
  },
  setPricePerUnit: function setPricePerUnit(price) {
    price = (price * 100).toString();
    document.querySelector('#checkout-button-sku_GDHDkOPWtjGF2w').querySelector('span').setAttribute('data-value', price);
  },
  set: function set(property, value) {
    welcomeCard[property] = value;
  },
  setup: function () {
    var _setup = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              if (welcomeCard.forms.payment.el() !== null) {
                welcomeCard.forms.payment.el().addEventListener('submit',
                /*#__PURE__*/
                function () {
                  var _ref = _asyncToGenerator(
                  /*#__PURE__*/
                  _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(event) {
                    var urlPaymentForm, paymentFeeDialog;
                    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
                      while (1) {
                        switch (_context.prev = _context.next) {
                          case 0:
                            event.preventDefault();
                            _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableFormInputs(event.target, true); // Sets the loader inside the button

                            _main_UI__WEBPACK_IMPORTED_MODULE_3__["default"].changeLoadingButtonState(event.target); // Gets the URL and make a request to the API

                            urlPaymentForm = event.target.getAttribute('action');
                            _context.next = 6;
                            return _main_api__WEBPACK_IMPORTED_MODULE_5__["default"].getDialog(urlPaymentForm, _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].getFormToken(event.target));

                          case 6:
                            paymentFeeDialog = _context.sent;
                            // Hides the loader once again.
                            _main_UI__WEBPACK_IMPORTED_MODULE_3__["default"].changeLoadingButtonState(event.target); // Sets the button to the initial state.

                            _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableFormInputs(event.target, false); // Replace dialog box.

                            welcomeCard.replaceDialog(paymentFeeDialog);

                          case 10:
                          case "end":
                            return _context.stop();
                        }
                      }
                    }, _callee);
                  }));

                  return function (_x) {
                    return _ref.apply(this, arguments);
                  };
                }());
              }

              if (!(welcomeCard.forms.checkout.el() !== null)) {
                _context2.next = 7;
                break;
              }

              if (welcomeCard.isStripeLoaded()) {
                _context2.next = 7;
                break;
              }

              welcomeCard.setStripeElements();
              _context2.next = 6;
              return welcomeCard.fetchRates();

            case 6:
              welcomeCard.rates = _context2.sent;

            case 7:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));

    function setup() {
      return _setup.apply(this, arguments);
    }

    return setup;
  }(),
  isCourseSelected: function isCourseSelected() {
    return document.getElementById('study');
  },
  isStripeLoaded: function isStripeLoaded() {
    return welcomeCard.forms.checkout.el().querySelector('#card-number').childElementCount > 0;
  },

  /**
   * Replace the existing element with ID #dialog-box
   * for the one passed as an argument.
   *
   * @param newDialogBox
   */
  replaceDialog: function replaceDialog(newDialogBox) {
    var container = welcomeCard.dialogBoxContainer().parentElement;
    $(welcomeCard.dialogBoxContainer()).empty();
    $(container).html(newDialogBox);
  },
  handleServerErrorField: function () {
    var _handleServerErrorField = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(field, element) {
      var errors;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return _main_api__WEBPACK_IMPORTED_MODULE_5__["default"].validate(field);

            case 2:
              errors = _context3.sent;

              if (errors !== null) {
                welcomeCard.displayInputFieldError(field.name, errors['value'][0]);
              } else {
                welcomeCard.removeInputFieldError(field.name);
              }

              return _context3.abrupt("return", errors);

            case 5:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }));

    function handleServerErrorField(_x2, _x3) {
      return _handleServerErrorField.apply(this, arguments);
    }

    return handleServerErrorField;
  }(),
  updatePaymentButton: function updatePaymentButton(value, currency) {
    var submitButtonText = $('#checkout-button-sku_GDHDkOPWtjGF2w > span')[0]; // Get only the text inside the button without the currency symbol and the value.

    var text = $(submitButtonText).text().match(new RegExp(/^([A-Z]?[\s\D][^A-Z\u00A5-\u20BF\u0024\u00A3\d.]+)/))[0];
    value = parseFloat(value).toLocaleString(document.documentElement.lang, {
      style: 'currency',
      currency: currency
    });
    $(submitButtonText).text(text + value);
  },
  setStripeElements: function setStripeElements() {
    welcomeCard.elements.stripe = stripe.elements({
      fonts: [{
        cssSrc: "https://fonts.googleapis.com/css?family=Montserrat"
      }]
    }); // Holdername element

    var cardHolderName = document.getElementById('card_holder_name'); // Phone Number element

    var phoneNumber = document.getElementById('phone_number'); // Email payer Element

    var cardEmailPayer = document.getElementById('email'); // Stripe Card Number element

    var cardNumber = welcomeCard.elements.stripe.create('cardNumber');
    cardNumber.mount('#card-number'); // Stripe Card Expiry element

    var cardExpiry = welcomeCard.elements.stripe.create('cardExpiry', {
      placeholder: 'MM / YY'
    });
    cardExpiry.mount('#card-expiry'); // Stripe Card CVC element

    var cvc = welcomeCard.elements.stripe.create('cardCvc', {
      placeholder: '123'
    });
    cvc.mount('#card-cvc');
    var paymentCurrency = document.getElementById('payment-currency');

    if (welcomeCard.isCourseSelected()) {
      welcomeCard.setPaymentAmount(welcomeCard.getPricePerUnit()); // Course Selector element

      var courseSelector = document.getElementById('study');
      courseSelector.addEventListener('change',
      /*#__PURE__*/
      function () {
        var _ref2 = _asyncToGenerator(
        /*#__PURE__*/
        _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4(event) {
          var selectedCourse;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
            while (1) {
              switch (_context4.prev = _context4.next) {
                case 0:
                  _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].toggleInputs(event.target.value, {
                    'in-person': $('#staying').parents().eq(2),
                    'online': $('#hours').parents().eq(2)
                  });
                  _context4.next = 3;
                  return _main_api__WEBPACK_IMPORTED_MODULE_5__["default"].getResource('courses', {
                    course: event.target.value
                  });

                case 3:
                  selectedCourse = _context4.sent;
                  welcomeCard.setPricePerUnit(selectedCourse.price.eur);
                  welcomeCard.setPaymentAmount(selectedCourse.price.eur, paymentCurrency.value);

                case 6:
                case "end":
                  return _context4.stop();
              }
            }
          }, _callee4);
        }));

        return function (_x4) {
          return _ref2.apply(this, arguments);
        };
      }()); // Duration and Staying Inputs

      var staying = document.getElementById('staying');
      staying.addEventListener('change',
      /*#__PURE__*/
      function () {
        var _ref3 = _asyncToGenerator(
        /*#__PURE__*/
        _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5(event) {
          var field, errors;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
            while (1) {
              switch (_context5.prev = _context5.next) {
                case 0:
                  field = {
                    value: event.target.value,
                    name: event.target.getAttribute('name'),
                    validators: ['required', 'integer', 'InPersonCoursesScope']
                  };
                  _context5.next = 3;
                  return welcomeCard.handleServerErrorField(field, event.target);

                case 3:
                  errors = _context5.sent;

                  if (!errors) {
                    _context5.next = 7;
                    break;
                  }

                  event.target.value = welcomeCard.minimumStaying;
                  return _context5.abrupt("return", false);

                case 7:
                  welcomeCard.setPaymentAmount(welcomeCard.getPricePerUnit(), paymentCurrency.value);

                case 8:
                case "end":
                  return _context5.stop();
              }
            }
          }, _callee5);
        }));

        return function (_x5) {
          return _ref3.apply(this, arguments);
        };
      }());
      var hours = document.getElementById('hours');
      hours.addEventListener('change',
      /*#__PURE__*/
      function () {
        var _ref4 = _asyncToGenerator(
        /*#__PURE__*/
        _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6(event) {
          var field, errors;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
            while (1) {
              switch (_context6.prev = _context6.next) {
                case 0:
                  field = {
                    value: event.target.value,
                    name: event.target.getAttribute('name'),
                    validators: ['required', 'integer', 'OnlineCoursesScope']
                  };
                  _context6.next = 3;
                  return welcomeCard.handleServerErrorField(field, event.target);

                case 3:
                  errors = _context6.sent;

                  if (!errors) {
                    _context6.next = 7;
                    break;
                  }

                  event.target.value = welcomeCard.minimumHours;
                  return _context6.abrupt("return", false);

                case 7:
                  welcomeCard.setPaymentAmount(welcomeCard.getPricePerUnit(), paymentCurrency.value);

                case 8:
                case "end":
                  return _context6.stop();
              }
            }
          }, _callee6);
        }));

        return function (_x6) {
          return _ref4.apply(this, arguments);
        };
      }()); // Set values to estimate the final price when the user changes
      // the course duration.

      welcomeCard.set('minimumHours', hours.value);
      welcomeCard.set('minimumStaying', staying.value);
    } // Payment Request Options


    var paymentRequest = stripe.paymentRequest({
      country: 'ES',
      currency: paymentCurrency.value,
      total: {
        amount: 3000,
        label: 'Application Fee'
      },
      requestPayerPhone: true,
      requestPayerEmail: true
    });
    welcomeCard.setStripePaymentRequestButton(welcomeCard.elements.stripe, paymentRequest);
    /**
     * STRIPE ELEMENTS EVENTS
     */

    cardHolderName.addEventListener('change', function (event) {
      var field = {
        value: event.target.value,
        name: event.target.getAttribute('name'),
        validators: ['ValidName']
      };
      welcomeCard.handleServerErrorField(field, event.target);
    });
    phoneNumber.addEventListener('change', function (event) {
      var field = {
        value: event.target.value,
        name: event.target.getAttribute('name'),
        validators: ['required', 'numeric', 'PhoneNumber']
      };
      welcomeCard.handleServerErrorField(field, event.target);
    });
    cardEmailPayer.addEventListener('change', function (event) {
      var field = {
        value: event.target.value,
        name: event.target.getAttribute('name'),
        validators: 'required|email'
      };
      welcomeCard.handleServerErrorField(field, event.target);
    });
    cardNumber.addEventListener('change', function (_ref5) {
      var error = _ref5.error;
      var displayError = document.getElementById('card-number-errors');
      welcomeCard.displayStripeErrors(displayError, error);
    });
    cvc.addEventListener('change', function (_ref6) {
      var error = _ref6.error;
      var displayError = document.getElementById('cvc-errors');
      welcomeCard.displayStripeErrors(displayError, error);
    });
    cardExpiry.addEventListener('change', function (_ref7) {
      var error = _ref7.error;
      var displayError = document.getElementById('card-expiry-errors');
      welcomeCard.displayStripeErrors(displayError, error);
    });
    paymentCurrency.addEventListener('change',
    /*#__PURE__*/
    function () {
      var _ref8 = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee7(e) {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee7$(_context7) {
          while (1) {
            switch (_context7.prev = _context7.next) {
              case 0:
                welcomeCard.setPaymentAmount(welcomeCard.getPricePerUnit(), e.target.value);

              case 1:
              case "end":
                return _context7.stop();
            }
          }
        }, _callee7);
      }));

      return function (_x7) {
        return _ref8.apply(this, arguments);
      };
    }());
    $(welcomeCard.forms.checkout.el()).on('submit',
    /*#__PURE__*/
    function () {
      var _ref9 = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee8(event) {
        var paymentDetails, validation, _ref10, paymentMethod, error, data;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee8$(_context8) {
          while (1) {
            switch (_context8.prev = _context8.next) {
              case 0:
                event.preventDefault(); // Sets the loader inside the checkout button.

                _main_UI__WEBPACK_IMPORTED_MODULE_3__["default"].changeLoadingButtonState(event.target);
                _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableFormInputs(event.target, true);
                _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableStripeInputs([cardNumber, cvc, cardExpiry], true);
                paymentDetails = {
                  card_holder_name: cardHolderName.value,
                  email: document.querySelector('#email').value,
                  phone_number: phoneNumber.value
                };

                if (!welcomeCard.isCourseSelected()) {
                  _context8.next = 14;
                  break;
                }

                paymentDetails[courseSelector.getAttribute('name')] = courseSelector.value;
                _context8.t0 = courseSelector.value;
                _context8.next = _context8.t0 === 'in-person' ? 10 : _context8.t0 === 'online' ? 12 : 14;
                break;

              case 10:
                paymentDetails['staying'] = document.getElementById('staying').value;
                return _context8.abrupt("break", 14);

              case 12:
                paymentDetails['hours'] = document.getElementById('hours').value;
                return _context8.abrupt("break", 14);

              case 14:
                _context8.next = 16;
                return _main_api__WEBPACK_IMPORTED_MODULE_5__["default"].validateFields('payment-details', paymentDetails);

              case 16:
                validation = _context8.sent;

                if (!validation.errors) {
                  _context8.next = 23;
                  break;
                }

                welcomeCard.handleErrorFields(Object.keys(validation.errors), validation.errors); // Hides the loader inside the checkout button.

                _main_UI__WEBPACK_IMPORTED_MODULE_3__["default"].changeLoadingButtonState(event.target); // Enables again the inputs of the checkout form.

                _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableFormInputs(event.target, false);
                _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableStripeInputs([cardNumber, cvc, cardExpiry], false);
                return _context8.abrupt("return", false);

              case 23:
                _context8.next = 25;
                return stripe.createPaymentMethod('card', cardNumber, {
                  billing_details: validation
                });

              case 25:
                _ref10 = _context8.sent;
                paymentMethod = _ref10.paymentMethod;
                error = _ref10.error;

                if (!error) {
                  _context8.next = 36;
                  break;
                }

                welcomeCard.displayInputFieldError('submit', error.message); // Sets the inputs to the initial state.

                _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableFormInputs(event.target, false);
                _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableStripeInputs([cardNumber, cvc, cardExpiry], false); // Hides the loader inside the checkout button.

                _main_UI__WEBPACK_IMPORTED_MODULE_3__["default"].changeLoadingButtonState(event.target);
                return _context8.abrupt("return", false);

              case 36:
                /**
                 * If no errors found it, gathers the information needed to Stripe PHP API
                 * so the payment can be applied in the server.
                 */
                data = {
                  _token: welcomeCard.forms.checkout.el().querySelector('input[type="hidden"').value,
                  currency: document.getElementById('payment-currency').value,
                  card_holder_name: paymentMethod.billing_details.name,
                  email: paymentMethod.billing_details.email,
                  phone_number: paymentMethod.billing_details.phone,
                  payment_method: paymentMethod.id
                };

                if (!welcomeCard.isCourseSelected()) {
                  _context8.next = 46;
                  break;
                }

                data.study = courseSelector.value;
                _context8.t1 = data.study;
                _context8.next = _context8.t1 === 'in-person' ? 42 : _context8.t1 === 'online' ? 44 : 46;
                break;

              case 42:
                data.staying = document.getElementById('staying').value;
                return _context8.abrupt("break", 46);

              case 44:
                data.hours = document.getElementById('hours').value;
                return _context8.abrupt("break", 46);

              case 46:
                /*
                 * Sends the information needed along the Payment Method ID.
                 */
                _main_api__WEBPACK_IMPORTED_MODULE_5__["default"].sendPaymentMethod(data).then(function (result) {
                  var error = result.data.error;

                  if (error) {
                    /*
                     * Displays the error coming from the server according to the field or
                     * parameter the error is related to.
                     */
                    welcomeCard.displayInputFieldError(error.field, error.message); // Enables again the inputs of the checkout form.

                    _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableFormInputs(event.target, false);
                    _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableStripeInputs([cardNumber, cvc, cardExpiry], false); // Hides the loader inside the checkout button.

                    _main_UI__WEBPACK_IMPORTED_MODULE_3__["default"].changeLoadingButtonState(event.target);
                  } else {
                    /*
                     * If the user do not get redirected by the server means:
                     *
                     * 1) The payment has failed and therefore an error response
                     * has been received from the server.
                     *
                     * OR
                     *
                     * 2) The Payment Intent needs a step further in the authentication
                     * process and gives back the Payment Intent Status
                     * as to let the user handle it. Perhaps their bank account asked
                     * him for a notification push message through his mobile phone or
                     * email
                     */
                    // In both cases the returned data is sent to a handler.
                    welcomeCard.handleServerResponse(result.data); // Enables again the inputs of the checkout form.

                    _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableFormInputs(event.target, false);
                    _main_Forms__WEBPACK_IMPORTED_MODULE_1__["default"].disableStripeInputs([cardNumber, cvc, cardExpiry], false); // Hides the loader inside the checkout button.

                    _main_UI__WEBPACK_IMPORTED_MODULE_3__["default"].changeLoadingButtonState(event.target);
                  }
                }); // Only when JavaScript is disabled
                // document.querySelector('#payment-method').value = paymentMethod.id;
                // welcomeCard.forms.checkout.el().submit();

              case 47:
              case "end":
                return _context8.stop();
            }
          }
        }, _callee8);
      }));

      return function (_x8) {
        return _ref9.apply(this, arguments);
      };
    }());
  },
  getCourseDuration: function getCourseDuration() {
    var courseSelector = document.querySelector('#study');

    if (welcomeCard.isCourseSelected()) {
      switch (courseSelector.value) {
        case 'in-person':
          return document.getElementById('staying').value;

        case 'online':
          return document.getElementById('hours').value;
      }
    }

    return 1;
  },
  setPaymentAmount: function () {
    var _setPaymentAmount = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee9(value) {
      var currency,
          _args9 = arguments;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee9$(_context9) {
        while (1) {
          switch (_context9.prev = _context9.next) {
            case 0:
              currency = _args9.length > 1 && _args9[1] !== undefined ? _args9[1] : 'eur';
              _context9.next = 3;
              return welcomeCard.currencyExchange(value, currency);

            case 3:
              value = _context9.sent;
              value *= welcomeCard.getCourseDuration();
              welcomeCard.updatePaymentButton(value, currency);

            case 6:
            case "end":
              return _context9.stop();
          }
        }
      }, _callee9);
    }));

    function setPaymentAmount(_x9) {
      return _setPaymentAmount.apply(this, arguments);
    }

    return setPaymentAmount;
  }(),
  displayStripeErrors: function displayStripeErrors(element, error) {
    if (error) {
      element.textContent = error.message;
      element.style.display = 'block';
    } else {
      element.textContent = '';
      element.style.display = 'none';
    }
  },
  handleServerResponse: function handleServerResponse(response) {
    /*
     * Gets the server response and checks whether the payment has failed or
     * else, the Payment Intent needs another step of authentication.
     */
    if (response.error) {
      welcomeCard.displayInputFieldError('submit', error.message);
    } else if (response.requires_action) {
      /*
       * Triggers the next authentication step or action where the user is likely
       * to be required for a 3D Secure (mandatory by the Strong Customer Authentication)
       * regulation in Europe.
       */
      stripe.handleCardAction(response.payment_intent_client_secret)
      /*
           * Sends the response to another handler which will try
           * to confirm the payment once again.
           */
      .then(welcomeCard.handleStripeJsResult);
    } else {
      /*
       * The payment has been successfully created and shows a confirmation dialog to the user.
       */
      welcomeCard.replaceDialog(response);
    }
  },

  /**
   * Receives the response of the «stripe.handleCardAction» method. If the Payment Intent
   * has sent an error it will show the error message just above the submit button. Otherwise
   * it will sent the Payment Method Intent ID to the server to finally complete and
   * confirm the payment linked to the Payment Method sent previously.
   *
   * @param result
   */
  handleStripeJsResult: function handleStripeJsResult(result) {
    if (result.error) {
      var displayError = document.getElementById('submit-errors');
      displayError.textContent = result.error.message;
      displayError.style.display = 'block';
    } else {
      var data = {
        _token: welcomeCard.forms.checkout.el().querySelector('input[type="hidden"').value,
        payment_intent_id: result.paymentIntent.id
      };
      _main_api__WEBPACK_IMPORTED_MODULE_5__["default"].sendPaymentMethod(data).then(function (confirmResult) {
        return confirmResult.data;
      }).then(function (view) {
        welcomeCard.handleServerResponse(view);
      });
    }
  },
  fetchRates: function () {
    var _fetchRates = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee10() {
      var url, response;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee10$(_context10) {
        while (1) {
          switch (_context10.prev = _context10.next) {
            case 0:
              url = 'https://api.exchangeratesapi.io/latest?base=EUR';
              _context10.prev = 1;
              _context10.next = 4;
              return axios({
                method: 'get',
                url: url
              });

            case 4:
              response = _context10.sent;
              _context10.next = 7;
              return response.data;

            case 7:
              return _context10.abrupt("return", _context10.sent);

            case 10:
              _context10.prev = 10;
              _context10.t0 = _context10["catch"](1);
              console.log(_context10.t0);

            case 13:
            case "end":
              return _context10.stop();
          }
        }
      }, _callee10, null, [[1, 10]]);
    }));

    function fetchRates() {
      return _fetchRates.apply(this, arguments);
    }

    return fetchRates;
  }(),
  currencyExchange: function () {
    var _currencyExchange = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee11(value, to) {
      var from,
          _args11 = arguments;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee11$(_context11) {
        while (1) {
          switch (_context11.prev = _context11.next) {
            case 0:
              from = _args11.length > 2 && _args11[2] !== undefined ? _args11[2] : 'EUR';

              if (to.toUpperCase() !== 'EUR') {
                value *= welcomeCard.rates.rates[to.toUpperCase()];
              }

              return _context11.abrupt("return", value);

            case 3:
            case "end":
              return _context11.stop();
          }
        }
      }, _callee11);
    }));

    function currencyExchange(_x10, _x11) {
      return _currencyExchange.apply(this, arguments);
    }

    return currencyExchange;
  }(),

  /*
   * Displays the given errors to the given fields.
   */
  handleErrorFields: function handleErrorFields(fields, errors) {
    if (Array.isArray(fields)) {
      fields.forEach(function (field) {
        welcomeCard.displayInputFieldError(field, errors[field][0]);
      });
    }
  },
  displayInputFieldError: function displayInputFieldError(field, error) {
    var displayError = document.getElementById(field + '-errors') !== null ? document.getElementById(field + '-errors') : document.getElementById('submit-errors');
    console.log(displayError);
    var input = document.getElementById(field) ? document.getElementById(field) : document.getElementById('card-' + field);

    if (input !== null) {
      input.classList.add('is-invalid');
    }

    displayError.style.display = 'block';
    displayError.textContent = error;
  },
  removeInputFieldError: function removeInputFieldError(field) {
    var displayError = document.getElementById(field + '-errors');
    var input = document.getElementById(field);
    displayError.style.display = 'none';

    if (input !== null) {
      input.classList.remove('is-invalid');
    }
  },
  redirectToCheckout: function redirectToCheckout(successUrl, cancelUrl) {
    stripe.redirectToCheckout({
      items: [{
        sku: 'sku_GDHDkOPWtjGF2w',
        quantity: 1
      }],
      // Do not rely on the redirect to the successUrl for fulfilling
      // purchases, customers may not always reach the success_url after
      // a successful payment.
      // Instead use one of the strategies described in
      // https://stripe.com/docs/payments/checkout/fulfillment
      successUrl: successUrl,
      cancelUrl: cancelUrl
    }).then(function (result) {
      if (result.error) {
        // If `redirectToCheckout` fails due to a browser or network
        // error, display the localized error message to your customer.
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  },
  setStripePaymentRequestButton: function setStripePaymentRequestButton(elements, paymentRequest) {
    var paymentRequestButton = elements.create('paymentRequestButton', {
      paymentRequest: paymentRequest
    });
    paymentRequest.canMakePayment().then(function (result) {
      if (result) {
        paymentRequestButton.mount('#payment-request-button');
      } else {
        document.getElementById('payment-request-button').style.display = 'none';
        document.getElementById('checkout-button-sku_GDHDkOPWtjGF2w').parentElement.style.display = 'block';
      }
    });
  }
};

if (document.querySelector('.user-card')) {
  welcomeCard.init();
}

/***/ }),

/***/ "./resources/js/components/filters/IndustryFilter.js":
/*!***********************************************************!*\
  !*** ./resources/js/components/filters/IndustryFilter.js ***!
  \***********************************************************/
/*! exports provided: industryFilterFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "industryFilterFactory", function() { return industryFilterFactory; });
/* harmony import */ var _factories_FiltersFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FiltersFactory */ "./resources/js/factories/FiltersFactory.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../facades/api */ "./resources/js/facades/api.js");



function IndustryFilter(options) {
  this.el = options.filter;
  this.callback = options.callback;

  this.init = function () {
    var _this = this;

    this.el.addEventListener('change', function (ev) {
      _this.applyFilter(_this.callback, ev.target.value);
    });
  };

  this.applyFilter = function (callback, filter) {
    _facades_api__WEBPACK_IMPORTED_MODULE_1__["default"].jQueryGet(_facades_api__WEBPACK_IMPORTED_MODULE_1__["default"].getRoute('offers'), null, [filter], function (data) {
      callback(data);
    });
  };

  this.init();
}

var industryFilterFactory = new _factories_FiltersFactory__WEBPACK_IMPORTED_MODULE_0__["FilterFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (IndustryFilter);

/***/ }),

/***/ "./resources/js/components/filters/Searchbox.js":
/*!******************************************************!*\
  !*** ./resources/js/components/filters/Searchbox.js ***!
  \******************************************************/
/*! exports provided: searchboxFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "searchboxFactory", function() { return searchboxFactory; });
/* harmony import */ var _factories_FiltersFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FiltersFactory */ "./resources/js/factories/FiltersFactory.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../facades/api */ "./resources/js/facades/api.js");
/* harmony import */ var _IndustryFilter__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./IndustryFilter */ "./resources/js/components/filters/IndustryFilter.js");




function Searchbox(options) {
  this.el = options.filter;
  this.callback = options.callback;

  this.init = function () {};
}

var searchboxFactory = new _factories_FiltersFactory__WEBPACK_IMPORTED_MODULE_0__["FilterFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (Searchbox);

/***/ }),

/***/ "./resources/js/components/filters/UserStatusFilter.js":
/*!*************************************************************!*\
  !*** ./resources/js/components/filters/UserStatusFilter.js ***!
  \*************************************************************/
/*! exports provided: userStatusFilterFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "userStatusFilterFactory", function() { return userStatusFilterFactory; });
/* harmony import */ var _factories_FiltersFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FiltersFactory */ "./resources/js/factories/FiltersFactory.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../facades/api */ "./resources/js/facades/api.js");



function UserStatusFilter(options) {
  this.el = options.filter;
  this.callback = options.callback;

  this.init = function () {
    var _this = this;

    this.el.addEventListener('change', function (ev) {
      _this.applyFilter(_this.callback, ev.target.value);
    });
  };

  this.applyFilter = function (callback, filter) {
    var url = window.location.protocol + '//' + window.location.hostname + '/' + _facades_api__WEBPACK_IMPORTED_MODULE_1__["default"].setParams('admin/users', {
      filter: filter
    });
    _facades_api__WEBPACK_IMPORTED_MODULE_1__["default"].jQueryGet(url, null, null, function (data) {
      callback(data);
    });
  };

  this.init();
}

var userStatusFilterFactory = new _factories_FiltersFactory__WEBPACK_IMPORTED_MODULE_0__["FilterFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (UserStatusFilter);

/***/ }),

/***/ "./resources/js/components/forms/ContactForm.js":
/*!******************************************************!*\
  !*** ./resources/js/components/forms/ContactForm.js ***!
  \******************************************************/
/*! exports provided: contactFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "contactFormFactory", function() { return contactFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _facades_browser__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../facades/browser */ "./resources/js/facades/browser.js");



function ContactForm(options) {
  this.fields = {
    name: $('#contact-name'),
    terms: $('#contact-terms').parents('.c-switch-input')[0]
  };

  this.toggleCheckableInput = function () {
    $(this.fields.terms).toggleClass('c-switch-input c-checkbox-input c-checkbox-input--footer');
    $(this.fields.terms).find('label:first-child').toggleClass('c-switch-input__label c-checkbox-input__label');
    $(this.fields.terms).find('.wrapper').toggleClass('c-switch-input__wrapper c-checkbox-input__wrapper');
  };
}

var contactFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (ContactForm);

/***/ }),

/***/ "./resources/js/components/forms/CreateFeeForm.js":
/*!********************************************************!*\
  !*** ./resources/js/components/forms/CreateFeeForm.js ***!
  \********************************************************/
/*! exports provided: createFeeFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createFeeFormFactory", function() { return createFeeFormFactory; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../facades/api */ "./resources/js/facades/api.js");
/* harmony import */ var _facades_dom__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../facades/dom */ "./resources/js/facades/dom.js");
/* harmony import */ var _facades_object__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../facades/object */ "./resources/js/facades/object.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }






function CreateFeeForm() {
  this.fields = {};
  this.init =
  /*#__PURE__*/
  _asyncToGenerator(
  /*#__PURE__*/
  _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
    var _this = this;

    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            this.fields.name = this.el.querySelector('#name');
            this.fields.heading = this.el.querySelector('#heading');
            this.fields.fee_type = this.el.querySelector('#fee_type');
            this.fields.amount = this.el.querySelector('#amount');
            this.setFieldsets();
            this.setInputFilter(this.fields.amount, function (value) {
              return _this.filters["float"].test(value);
            });
            this.setInputFilter(this.fieldsets.minimum, function (value) {
              return _this.filters.integer.test(value);
            });
            this.fields.fee_type.addEventListener('change',
            /*#__PURE__*/
            function () {
              var _ref2 = _asyncToGenerator(
              /*#__PURE__*/
              _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(ev) {
                var programs;
                return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
                  while (1) {
                    switch (_context.prev = _context.next) {
                      case 0:
                        _this.toggleLoadingState();

                        _context.next = 3;
                        return _facades_api__WEBPACK_IMPORTED_MODULE_2__["default"].axiosRequest(_facades_api__WEBPACK_IMPORTED_MODULE_2__["default"].getRoute('hostname') + '/admin/programs', 'post', {
                          fee_type: ev.target.value
                        });

                      case 3:
                        programs = _context.sent;

                        _this.updateFeeFieldset(programs);

                        _this.toggleLoadingState();

                      case 6:
                      case "end":
                        return _context.stop();
                    }
                  }
                }, _callee);
              }));

              return function (_x) {
                return _ref2.apply(this, arguments);
              };
            }());

          case 8:
          case "end":
            return _context2.stop();
        }
      }
    }, _callee2, this);
  }));

  this.updateFeeFieldset = function (programs) {
    if (typeof this.fields.fee_type === 'undefined') {
      return null;
    }

    ;

    switch (this.fields.fee_type.value) {
      case 'unit_rate':
        _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].show(this.fieldsets.minimum);
        _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].show(this.fieldsets.unit);
        break;

      case 'entry_fee':
        _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].hide(this.fieldsets.minimum);
        _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].hide(this.fieldsets.unit);
        break;
    }

    programs = _facades_object__WEBPACK_IMPORTED_MODULE_4__["default"].arrayValues(programs, 'value');
    programs.indexOf('internship') !== -1 || programs.indexOf('inter_relocat') !== -1 ? _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].show(this.fieldsets.industry) : _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].hide(this.fieldsets.industry);
    programs.indexOf('study') !== -1 ? _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].show(this.fieldsets.study) : _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].hide(this.fieldsets.study);
    programs.indexOf('university') !== -1 ? _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].show(this.fieldsets.university) : _facades_dom__WEBPACK_IMPORTED_MODULE_3__["default"].hide(this.fieldsets.university);
  };

  this.setFieldsets = function () {
    this.fieldsets = {
      industry: document.getElementById('industryFieldset'),
      study: document.getElementById('studyFieldset'),
      university: document.getElementById('universityFieldset'),
      minimum: document.getElementById('minimumFieldset'),
      unit: document.getElementById('unitFieldset')
    };
  };
}

var createFeeFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_1__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (CreateFeeForm);

/***/ }),

/***/ "./resources/js/components/forms/CreateOfferForm.js":
/*!**********************************************************!*\
  !*** ./resources/js/components/forms/CreateOfferForm.js ***!
  \**********************************************************/
/*! exports provided: createOfferFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createOfferFormFactory", function() { return createOfferFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");


function CreateOfferForm() {
  this.fields = {};

  this.init = function () {
    var _this = this;

    this.fields.title = this.el.querySelector('#title');
    this.fields.location = this.el.querySelector('#location');
    this.fields.industry = this.el.querySelector('#industry');
    this.fields.description = this.el.querySelector('#description');
    this.editor = this.el.querySelector('#description-editor');
    this.previewUploadedFiles();
    this.editor = this.mountWYSIWYGEditor();
    this.el.addEventListener('submit', function (ev) {
      _this.fields.description.value = JSON.stringify(_this.editor.getContents());
    });
    return this;
  };
}

var createOfferFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (CreateOfferForm);

/***/ }),

/***/ "./resources/js/components/forms/DeleteFeeForm.js":
/*!********************************************************!*\
  !*** ./resources/js/components/forms/DeleteFeeForm.js ***!
  \********************************************************/
/*! exports provided: deleteFeeFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "deleteFeeFormFactory", function() { return deleteFeeFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _components_Modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/Modal */ "./resources/js/components/Modal.js");



function DeleteFeeForm(options) {
  this.fields = {};

  this.init = function () {
    if (this.modal !== null) {
      this.modal = _components_Modal__WEBPACK_IMPORTED_MODULE_1__["modalsFactory"].createModal({
        el: document.getElementById('deleteFeeModal')
      }).init();
    }

    this.fields.token = this.el.querySelector('[name=token]');
    return this;
  };
}

var deleteFeeFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (DeleteFeeForm);

/***/ }),

/***/ "./resources/js/components/forms/DeleteOfferForm.js":
/*!**********************************************************!*\
  !*** ./resources/js/components/forms/DeleteOfferForm.js ***!
  \**********************************************************/
/*! exports provided: deleteOfferFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "deleteOfferFormFactory", function() { return deleteOfferFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _components_Modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/Modal */ "./resources/js/components/Modal.js");



function DeleteOfferForm(options) {
  this.fields = {};

  this.init = function () {
    if (this.modal !== null) {
      this.modal = _components_Modal__WEBPACK_IMPORTED_MODULE_1__["modalsFactory"].createModal({
        el: document.getElementById('deleteOfferModal')
      }).init();
    }

    this.fields.token = this.el.querySelector('[name=token]');
    return this;
  };
}

var deleteOfferFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (DeleteOfferForm);

/***/ }),

/***/ "./resources/js/components/forms/DeleteUserForm.js":
/*!*********************************************************!*\
  !*** ./resources/js/components/forms/DeleteUserForm.js ***!
  \*********************************************************/
/*! exports provided: deleteUserFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "deleteUserFormFactory", function() { return deleteUserFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _components_Modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/Modal */ "./resources/js/components/Modal.js");



function DeleteUserForm(options) {
  this.fields = {};

  this.init = function () {
    if (this.modal !== null) {
      this.modal = _components_Modal__WEBPACK_IMPORTED_MODULE_1__["modalsFactory"].createModal({
        el: document.getElementById('deleteUserModal')
      }).init();
    }

    this.fields.token = this.el.querySelector('[name=token]');
    return this;
  };
}

var deleteUserFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (DeleteUserForm);

/***/ }),

/***/ "./resources/js/components/forms/EditFeeForm.js":
/*!******************************************************!*\
  !*** ./resources/js/components/forms/EditFeeForm.js ***!
  \******************************************************/
/*! exports provided: editFeeFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "editFeeFormFactory", function() { return editFeeFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _EditOfferForm__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EditOfferForm */ "./resources/js/components/forms/EditOfferForm.js");
/* harmony import */ var _facades_dom__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../facades/dom */ "./resources/js/facades/dom.js");




function EditFeeForm(options) {
  this.fields = {};

  this.init = function () {
    var _this = this;

    this.fields.name = this.el.querySelector('#name');
    this.fields.unit = this.el.querySelector('#unit');
    this.fields.heading = this.el.querySelector('#unit');
    this.fields.amount = this.el.querySelector('#amount');
    this.fields.minimum = this.el.querySelector('#minimum');
    this.fields.tax = this.el.querySelector('#tax');
    this.setInputFilter(this.fields.amount, function (value) {
      return _this.filters["float"].test(value);
    });
    this.setInputFilter(this.fields.minimum, function (value) {
      return _this.filters.integer.test(value);
    });
  };
}

var editFeeFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (EditFeeForm);

/***/ }),

/***/ "./resources/js/components/forms/EditOfferForm.js":
/*!********************************************************!*\
  !*** ./resources/js/components/forms/EditOfferForm.js ***!
  \********************************************************/
/*! exports provided: editOfferFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "editOfferFormFactory", function() { return editOfferFormFactory; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../facades/api */ "./resources/js/facades/api.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }




function EditOfferForm(options) {
  this.fields = {};
  this.editor = null;
  this.init =
  /*#__PURE__*/
  _asyncToGenerator(
  /*#__PURE__*/
  _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
    var _this = this;

    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            this.fields.id = this.el.querySelector('#id');
            this.fields.title = this.el.querySelector('#title');
            this.fields.location = this.el.querySelector('#location');
            this.fields.industry = this.el.querySelector('#industry');
            this.fields.description = this.el.querySelector('#description');
            this.editor = this.el.querySelector('#description-editor');
            _context.next = 8;
            return _facades_api__WEBPACK_IMPORTED_MODULE_2__["default"].axiosRequest(_facades_api__WEBPACK_IMPORTED_MODULE_2__["default"].getResource('offers', this.fields.id.value), 'get');

          case 8:
            this.offer = _context.sent;
            this.previewUploadedFiles().loadDescription();
            this.el.addEventListener('submit', function (ev) {
              ev.preventDefault();
              _this.fields.description.value = JSON.stringify(_this.editor.getContents());

              _this.el.submit();
            });

          case 11:
          case "end":
            return _context.stop();
        }
      }
    }, _callee, this);
  }));

  this.loadDescription = function () {
    var description = this.editor.getAttribute('data-html');
    this.editor = this.mountWYSIWYGEditor();

    if (this.offer.data.description !== null) {
      this.editor.setContents(JSON.parse(this.offer.data.description));
    }

    return this;
  };
}

var editOfferFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_1__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (EditOfferForm);

/***/ }),

/***/ "./resources/js/components/forms/EditUserForm.js":
/*!*******************************************************!*\
  !*** ./resources/js/components/forms/EditUserForm.js ***!
  \*******************************************************/
/*! exports provided: editUserFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "editUserFormFactory", function() { return editUserFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");


function EditUserForm() {
  this.fields = {};
  this.fieldsets = {
    industry: document.getElementById('industryFieldset'),
    study: document.getElementById('studyFieldset'),
    university: document.getElementById('universityFieldset')
  };

  this.init = function () {
    var _this = this;

    this.fields = {
      name: this.el.querySelector('#name'),
      surnames: this.el.querySelector('#surnames'),
      email: this.el.querySelector('#email'),
      phone_number: {
        prefix: document.getElementById('prefix'),
        number: document.getElementById('phone-number')
      },
      program: document.getElementById('program'),
      cv: document.getElementById('cv')
    };
    this.fields.program.addEventListener('change', function () {
      _this.updateFieldset(_this);
    }, this);
  };
}

var editUserFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (EditUserForm);

/***/ }),

/***/ "./resources/js/components/forms/LoginForm.js":
/*!****************************************************!*\
  !*** ./resources/js/components/forms/LoginForm.js ***!
  \****************************************************/
/*! exports provided: loginFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "loginFormFactory", function() { return loginFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _Modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Modal */ "./resources/js/components/Modal.js");



function LoginForm(options) {
  this.fields = {};
  this.modal = options.modal ? options.modal : null;

  this.init = function () {
    this.fields.email = this.el.querySelector('#login-email');
    this.fields.password = this.el.querySelector('#login-password');
    this.fields.token = this.el.querySelector('[name=_token]');
    this.setModal();
  };

  this.setModal = function () {
    if (this.modal !== null) {
      this.modal = _Modal__WEBPACK_IMPORTED_MODULE_1__["modalsFactory"].createModal({
        el: this.modal,
        autofocus: true
      });
    }

    return this;
  };
}

var loginFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (LoginForm);

/***/ }),

/***/ "./resources/js/components/forms/PaymentForm.js":
/*!******************************************************!*\
  !*** ./resources/js/components/forms/PaymentForm.js ***!
  \******************************************************/
/*! exports provided: paymentFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "paymentFormFactory", function() { return paymentFormFactory; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _Dialog__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../Dialog */ "./resources/js/components/Dialog.js");
/* harmony import */ var _facades_str__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../facades/str */ "./resources/js/facades/str.js");
/* harmony import */ var _facades_money__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../facades/money */ "./resources/js/facades/money.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../facades/api */ "./resources/js/facades/api.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }







function PaymentForm(options) {
  var _this3 = this;

  this.stripeElements = ['card'];
  this.stripeElementsStyles = {
    generic: {
      base: {}
    }
  };
  /**
   * Form fields
   *
   * @type {{duration: {lessons: HTMLElement, months: HTMLElement}, card_holder: HTMLElement, courses: HTMLElement, stripe: {}, phone_number: HTMLElement, currency: HTMLElement, payment: Element, email: HTMLElement, card: {number: HTMLElement, cvc: HTMLElement, expiry: HTMLElement}}}
   */

  this.fields = {
    card_holder: document.getElementById('card_holder'),
    prefix: document.getElementById('prefix'),
    phone_number: document.getElementById('phone_number'),
    email: document.getElementById('payment-email'),
    course: document.getElementById('course'),
    total: document.getElementById('total'),
    subtotal: document.getElementById('subtotal'),
    card: {
      number: document.getElementById('card-number'),
      cvc: document.getElementById('card-cvc'),
      expiry: document.getElementById('card-expiry')
    },
    payment: document.getElementById('checkout-button-sku_GDHDkOPWtjGF2w'),
    token: document.getElementsByName('_token')[0],
    stripe: {}
  }; // Dialog component

  this.dialog = null;
  this.paymentIntent = null; // Selected course

  this.course = null; // Payment details

  this.paymentDetails = null;
  this.stripe = null; // Used patterns

  this.patterns = {
    getActionText: new RegExp(/^([A-Z]?[\s\D][^A-Z\u00A5-\u20BF\u0024\u00A3\d.]+)/)
  };
  this.dialog = null;
  this.price = {};
  this.pricePerUnit = null;
  this.getCourseDuration = function () {
    var obj = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

    if (this.fields.course !== null) {
      if (obj !== null) {
        obj[pluralize.plural(this.course.data.fee.unit)] = this.fields[pluralize.plural(this.course.data.fee.unit)].value;
        return obj;
      }

      return this.fields[pluralize.plural(this.course.data.fee.unit)].value;
    }

    return 1;
  }, this.setUnitFields = function () {
    var _this = this;

    this.fields[pluralize.plural(this.course.data.fee.unit)] = this.el.querySelector('#' + pluralize.plural(this.course.data.fee.unit));
    this.fields[pluralize.plural(this.course.data.fee.unit)].addEventListener('change',
    /*#__PURE__*/
    function () {
      var _ref = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(event) {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _this.toggleLoadingState();

                _this.disableStripeInputs();

                _this.setSubtotal().setTotal();

                _this.toggleLoadingState();

                _this.disableStripeInputs(false);

              case 5:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }));

      return function (_x) {
        return _ref.apply(this, arguments);
      };
    }());
  }, this.init =
  /*#__PURE__*/
  _asyncToGenerator(
  /*#__PURE__*/
  _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4() {
    var _this2 = this;

    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
      while (1) {
        switch (_context4.prev = _context4.next) {
          case 0:
            if (!(this.el !== null)) {
              _context4.next = 15;
              break;
            }

            this.dialog = _Dialog__WEBPACK_IMPORTED_MODULE_2__["dialogFactory"].createDialog();
            this.loadStripeElements();
            this.pricePerUnit = this.fields.payment.querySelector('span').getAttribute('data-value') / 100;

            if (!(this.fields.course !== null)) {
              _context4.next = 11;
              break;
            }

            _context4.next = 7;
            return _facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].axiosRequest(_facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].getResource('courses', this.fields.course.value));

          case 7:
            this.course = _context4.sent;
            this.setUnitFields();
            this.setSubtotal().setTotal();
            this.fields.course.addEventListener('change',
            /*#__PURE__*/
            function () {
              var _ref3 = _asyncToGenerator(
              /*#__PURE__*/
              _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(event) {
                var oldInput;
                return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
                  while (1) {
                    switch (_context2.prev = _context2.next) {
                      case 0:
                        _this2.toggleLoadingState();

                        _this2.disableStripeInputs();

                        oldInput = _this2.fields[pluralize.plural(_this2.course.data.fee.unit)];
                        _context2.next = 5;
                        return _facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].axiosRequest(_facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].getResource('courses', event.target.value));

                      case 5:
                        _this2.course = _context2.sent;

                        _this2.setUnitFields();

                        _this2.toggleInputs([oldInput, _this2.fields[pluralize.plural(_this2.course.data.fee.unit)]]);

                        _this2.setSubtotal().setTotal();

                        _this2.toggleLoadingState();

                        _this2.disableStripeInputs(false);

                      case 11:
                      case "end":
                        return _context2.stop();
                    }
                  }
                }, _callee2);
              }));

              return function (_x2) {
                return _ref3.apply(this, arguments);
              };
            }());

          case 11:
            this.fields.card_holder.addEventListener('change', function (event) {
              _this2.validateField(event.target, ['ValidName']);
            });
            this.fields.phone_number.addEventListener('change', function (event) {
              _this2.validateField(event.target, ['required', 'numeric', 'PhoneNumber']);
            });
            this.fields.email.addEventListener('change', function (event) {
              _this2.validateField(event.target, ['required', 'email']);
            });
            $(this.el).on('submit',
            /*#__PURE__*/
            function () {
              var _ref4 = _asyncToGenerator(
              /*#__PURE__*/
              _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(event) {
                var validation, _ref5, paymentMethod, error, paymentInformation;

                return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
                  while (1) {
                    switch (_context3.prev = _context3.next) {
                      case 0:
                        event.preventDefault();

                        _this2.toggleLoadingState();

                        _this2.disableStripeInputs();

                        _this2.paymentDetails = _this2.createPaymentDetails();
                        /*
                         * If the validation succeeds returns an object with the billing
                         * details.
                         */

                        _context3.next = 6;
                        return _this2.validatePaymentDetails();

                      case 6:
                        validation = _context3.sent;
                        console.log(validation);
                        /*
                         * If errors have been encountered display the corresponding
                         * messages.
                         */

                        if (!validation.errors) {
                          _context3.next = 13;
                          break;
                        }

                        Object.keys(_this2.paymentDetails).forEach(function (fieldName) {
                          if (validation.errors[fieldName] !== undefined) {
                            _this2.displayFieldError(_this2.fields[fieldName], validation.errors[fieldName][0]);
                          } else {
                            _this2.removeFieldError(_this2.fields[fieldName]);
                          }
                        });

                        _this2.toggleLoadingState();

                        _this2.disableStripeInputs(false);

                        return _context3.abrupt("return", false);

                      case 13:
                        _context3.next = 15;
                        return stripe.createPaymentMethod('card', _this2.fields.stripe['card-number'], {
                          billing_details: validation
                        });

                      case 15:
                        _ref5 = _context3.sent;
                        paymentMethod = _ref5.paymentMethod;
                        error = _ref5.error;

                        if (!error) {
                          _context3.next = 22;
                          break;
                        }

                        _this2.toggleLoadingState();

                        _this2.disableStripeInputs(false);

                        return _context3.abrupt("return", false);

                      case 22:
                        paymentInformation = {
                          _token: _this2.fields.token !== null ? _this2.fields.token.value : null,
                          card_holder: _this2.fields.card_holder !== null ? _this2.fields.card_holder.value : null,
                          email: paymentMethod.billing_details.email,
                          prefix: _this2.fields.prefix.value,
                          phone_number: paymentMethod.billing_details.phone,
                          dialog: _this2.dialog !== null,
                          quantity: _this2.course !== null ? _this2.fields[pluralize.plural(_this2.course.data.fee.unit)].value : null,
                          course: _this2.fields.course !== null ? _this2.fields.course.value : null,
                          payment_method: paymentMethod.id
                        };

                        _this2.getCourseDuration(paymentInformation);

                        _this2.sendPaymentInformation(paymentInformation);

                      case 25:
                      case "end":
                        return _context3.stop();
                    }
                  }
                }, _callee3);
              }));

              return function (_x3) {
                return _ref4.apply(this, arguments);
              };
            }());

          case 15:
          case "end":
            return _context4.stop();
        }
      }
    }, _callee4, this);
  }));

  this.sendPaymentInformation =
  /*#__PURE__*/
  function () {
    var _ref6 = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5(paymentInformation) {
      var result;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
        while (1) {
          switch (_context5.prev = _context5.next) {
            case 0:
              _context5.next = 2;
              return _facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].axiosRequest(_facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].getRoute('payment_method'), 'post', paymentInformation);

            case 2:
              result = _context5.sent;

              if (!result.error) {
                _context5.next = 8;
                break;
              }

              this.displayStripeErrors('submit', result.error.message);
              this.toggleLoadingState();
              this.disableStripeInputs(false);
              return _context5.abrupt("return", this);

            case 8:
              this.handlePaymentResponse(result);

            case 9:
            case "end":
              return _context5.stop();
          }
        }
      }, _callee5, this);
    }));

    return function (_x4) {
      return _ref6.apply(this, arguments);
    };
  }();
  /**
   * Receives the response of the «stripe.handleCardAction» method. If the Payment Intent
   * has sent an error it will show the error message just above the submit button. Otherwise
   * it will sent the Payment Method Intent ID to the server to finally complete and
   * confirm the payment linked to the Payment Method sent previously.
   *
   * @param result
   */


  this.handleStripeJsResult = function (result) {
    if (result.error) {
      _this3.displayStripeErrors('submit', result.error.message);

      return result;
    }

    _this3.paymentIntent = result.paymentIntent;

    _this3.sendPaymentInformation({
      token: _this3.fields.token.value,
      payment_intent_id: result.paymentIntent.id
    });
  };

  this.handlePaymentResponse =
  /*#__PURE__*/
  function () {
    var _ref7 = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6(response) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
        while (1) {
          switch (_context6.prev = _context6.next) {
            case 0:
              console.log(response);
              /*
               * Gets the server response and checks whether the payment has failed.
               */

              if (!response.error) {
                _context6.next = 4;
                break;
              }

              this.displayStripeErrors('submit', response.error.message);
              return _context6.abrupt("return", this);

            case 4:
              if (!response.requires_action) {
                _context6.next = 7;
                break;
              }

              /*
               * Triggers the next authentication step or action where the user is likely
               * to be required for a 3D Secure (mandatory by the Strong Customer Authentication)
               * regulation in Europe.
               */
              stripe.confirmCardPayment(response.payment_intent_client_secret).then(this.handleStripeJsResult); // stripe.handleCardAction(response.payment_intent_client_secret)
              //    .then((result) => {
              //        console.log(result);
              //    });

              return _context6.abrupt("return", this);

            case 7:
              if (!(this.dialog !== null)) {
                _context6.next = 10;
                break;
              }

              this.dialog.replace(response);
              return _context6.abrupt("return", this);

            case 10:
              this.paymentIntent = response;
              this.sendPaymentInformation({
                token: this.fields.token.value,
                payment_intent_id: this.paymentIntent.id
              });
              window.location.href = _facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].setLaravelParams(_facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].getRoute('paid'), [this.getCharge()]);

            case 13:
            case "end":
              return _context6.stop();
          }
        }
      }, _callee6, this);
    }));

    return function (_x5) {
      return _ref7.apply(this, arguments);
    };
  }();

  this.getCharge = function () {
    return this.paymentIntent.charges.data[0].id;
  };

  this.createPaymentDetails = function () {
    var obj = {
      name: 'payment-details',
      card_holder: this.fields.card_holder.value,
      phone_number: this.fields.phone_number.value,
      email: this.fields.email.value
    };

    if (this.course !== null) {
      obj['course'] = this.course.data.value;
      obj[pluralize.plural(this.course.data.fee.unit)] = this.fields[pluralize.plural(this.course.data.fee.unit)].value;
    }

    ;
    return obj;
  };

  this.validatePaymentDetails =
  /*#__PURE__*/
  _asyncToGenerator(
  /*#__PURE__*/
  _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee7() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee7$(_context7) {
      while (1) {
        switch (_context7.prev = _context7.next) {
          case 0:
            _context7.next = 2;
            return _facades_api__WEBPACK_IMPORTED_MODULE_5__["default"].validate(this.paymentDetails);

          case 2:
            return _context7.abrupt("return", _context7.sent);

          case 3:
          case "end":
            return _context7.stop();
        }
      }
    }, _callee7, this);
  }));

  this.setMinimumDuration = function (unit) {
    if (this.fields.course !== null) {
      if (this.course.data.fee.minimum > this.fields[unit].value) {
        this.fields[unit].value = this.course.data.fee.minimum;
      }
    }

    return this;
  };

  this.isStripeLoaded = function () {
    return this.fields.stripe.card.number.childElementCount > 0;
  };

  this.disableStripeInputs = function () {
    var _this4 = this;

    var disabled = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    Object.keys(this.fields.stripe).forEach(function (key) {
      _this4.fields.stripe[key].update({
        disabled: disabled
      });
    });
    return this;
  };

  this.displayStripeErrors = function (fieldName, message) {
    if (fieldName !== 'submit') {
      var formGroup = $('#' + fieldName).parents('.form-group')[0];
      $(formGroup).find('.StripeElement').each(function (index, element) {
        $(element).addClass('is-invalid');
      });
      $(formGroup).find('.invalid-feedback').each(function (index, element) {
        $(element).css('display', 'block');
      });
      $(formGroup).find('#' + fieldName + '-errors').text(message);
      return this;
    }

    $('#' + fieldName + '-errors').text(message);
  };

  this.removeStripeErrors = function (fieldName) {
    var formGroup = $('#' + fieldName).parents('.form-group')[0];
    $(formGroup).find('.StripeElement').each(function (index, element) {
      $(element).removeClass('is-invalid');
    });
    $(formGroup).find('#' + fieldName + '-errors').empty();
  };

  this.mountStripeFields = function () {
    var _this5 = this;

    this.stripeElements.forEach(function (element) {
      if (_this5.fields[element] !== null && _this5.fields[element][Symbol.iterator] !== 'function') {
        Object.keys(_this5.fields[element]).map(function (key) {
          var fieldName = _facades_str__WEBPACK_IMPORTED_MODULE_3__["default"].kebabCase(element + ' ' + key);
          _this5.fields.stripe[fieldName] = _this5.stripe.create(_facades_str__WEBPACK_IMPORTED_MODULE_3__["default"].camelCase(element + ' ' + key), {
            style: _this5.stripeElementsStyles.generic
          });

          _this5.fields.stripe[fieldName].mount('#' + _this5.fields[element][key].getAttribute('id'));

          _this5.fields.stripe[fieldName].addEventListener('change', function (_ref9) {
            var error = _ref9.error;

            if (error !== undefined) {
              _this5.displayStripeErrors(fieldName, error.message);
            } else {
              _this5.removeStripeErrors(fieldName);
            }
          });
        });
        return;
      }

      ;

      _this5.fields.stripe.create(element, {
        style: _this5.stripeElementsStyles.generic
      });
    });
  };

  this.setSubtotal = function () {
    console.log(this.course);

    if (this.course !== null) {
      this.price.subtotal = this.course.data.fee.amount * this.fields[pluralize.plural(this.course.data.fee.unit)].value;
      return this;
    }

    this.price.subtotal = this.pricePerUnit;
    return this;
  };

  this.setTotal = function () {
    var currency = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'eur';
    var percentage = this.course.data.fee.applicable_vat.percentage / 100;
    this.price.total = this.price.subtotal + this.price.subtotal * percentage;
    this.displayTotalPrice();
    return this;
  };

  this.loadStripeElements = function () {
    this.stripe = stripe.elements({
      fonts: [{
        cssSrc: "https://fonts.googleapis.com/css?family=Montserrat"
      }]
    });
    this.mountStripeFields();
    return this;
  };

  this.displayTotalPrice =
  /*#__PURE__*/
  _asyncToGenerator(
  /*#__PURE__*/
  _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee8() {
    var currency,
        verb,
        total,
        subtotal,
        regexp,
        _args8 = arguments;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee8$(_context8) {
      while (1) {
        switch (_context8.prev = _context8.next) {
          case 0:
            currency = _args8.length > 0 && _args8[0] !== undefined ? _args8[0] : 'eur';
            verb = $(this.fields.payment).children('span')[0].textContent.match(this.patterns.getActionText)[0];
            _context8.t0 = parseFloat;
            _context8.next = 5;
            return _facades_money__WEBPACK_IMPORTED_MODULE_4__["default"].exchangeCurrency(this.price.total, currency);

          case 5:
            _context8.t1 = _context8.sent;
            _context8.t2 = document.documentElement.lang;
            _context8.t3 = {
              style: 'currency',
              currency: currency
            };
            total = (0, _context8.t0)(_context8.t1).toLocaleString(_context8.t2, _context8.t3);
            _context8.t4 = parseFloat;
            _context8.next = 12;
            return _facades_money__WEBPACK_IMPORTED_MODULE_4__["default"].exchangeCurrency(this.price.subtotal, currency);

          case 12:
            _context8.t5 = _context8.sent;
            _context8.t6 = document.documentElement.lang;
            _context8.t7 = {
              style: 'currency',
              currency: currency
            };
            subtotal = (0, _context8.t4)(_context8.t5).toLocaleString(_context8.t6, _context8.t7);
            ;
            this.fields.subtotal.textContent = subtotal;
            $(this.fields.payment).children('span')[0].textContent = verb + total;
            regexp = /[€|$]((\d{1,3},)*\d{1,3}\.\d*)/g;
            _context8.t8 = $(this.fields.total).children('span')[0].textContent;
            _context8.t9 = regexp;
            _context8.t10 = parseFloat;
            _context8.next = 25;
            return _facades_money__WEBPACK_IMPORTED_MODULE_4__["default"].exchangeCurrency(this.price.total - this.price.subtotal, currency);

          case 25:
            _context8.t11 = _context8.sent;
            _context8.t12 = document.documentElement.lang;
            _context8.t13 = {
              style: 'currency',
              currency: currency
            };
            _context8.t14 = (0, _context8.t10)(_context8.t11).toLocaleString(_context8.t12, _context8.t13);
            $(this.fields.total).children('span')[0].textContent = _context8.t8.replace.call(_context8.t8, _context8.t9, _context8.t14);
            $(this.fields.total).children('span')[2].textContent = $(this.fields.total).children('span')[2].textContent.replace(regexp, subtotal);
            $(this.fields.total).children('span.total')[0].textContent = total;
            return _context8.abrupt("return", this);

          case 33:
          case "end":
            return _context8.stop();
        }
      }
    }, _callee8, this);
  }));
}

var paymentFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_1__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (PaymentForm);

/***/ }),

/***/ "./resources/js/components/forms/ProceedPaymentForm.js":
/*!*************************************************************!*\
  !*** ./resources/js/components/forms/ProceedPaymentForm.js ***!
  \*************************************************************/
/*! exports provided: proceedPaymentFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "proceedPaymentFormFactory", function() { return proceedPaymentFormFactory; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _PaymentForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PaymentForm */ "./resources/js/components/forms/PaymentForm.js");
/* harmony import */ var _Dialog__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../Dialog */ "./resources/js/components/Dialog.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../facades/api */ "./resources/js/facades/api.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }






function ProceedPaymentForm(options) {
  this.dialog = null;
  this.paymentForm = null, this.init = function () {
    var _this = this;

    if (this.el !== null) {
      this.dialog = _Dialog__WEBPACK_IMPORTED_MODULE_3__["dialogFactory"].createDialog();
      this.fields = {
        token: this.el.querySelector('[name=_token]')
      };
      this.el.addEventListener('submit',
      /*#__PURE__*/
      function () {
        var _ref = _asyncToGenerator(
        /*#__PURE__*/
        _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(event) {
          var dialog;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
            while (1) {
              switch (_context.prev = _context.next) {
                case 0:
                  event.preventDefault();

                  if (!(_this.dialog !== null)) {
                    _context.next = 9;
                    break;
                  }

                  _this.toggleLoadingState();

                  _context.next = 5;
                  return _this.submit();

                case 5:
                  dialog = _context.sent;
                  _this.dialog = _this.dialog.replace(dialog);
                  _this.paymentForm = _PaymentForm__WEBPACK_IMPORTED_MODULE_2__["paymentFormFactory"].createForm({
                    form: document.getElementById('payment'),
                    type: 'payment'
                  });

                  _this.paymentForm.init();

                case 9:
                  event.target.submit();

                case 10:
                case "end":
                  return _context.stop();
              }
            }
          }, _callee);
        }));

        return function (_x) {
          return _ref.apply(this, arguments);
        };
      }());
    }
  };
  this.submit =
  /*#__PURE__*/
  _asyncToGenerator(
  /*#__PURE__*/
  _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            _context2.next = 2;
            return _facades_api__WEBPACK_IMPORTED_MODULE_4__["default"].axiosRequest(this.getActionUrl(), 'post', {
              _token: this.getToken()
            });

          case 2:
            return _context2.abrupt("return", _context2.sent);

          case 3:
          case "end":
            return _context2.stop();
        }
      }
    }, _callee2, this);
  }));

  this.getToken = function () {
    return this.fields.token.value;
  };
}

var proceedPaymentFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_1__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (ProceedPaymentForm);

/***/ }),

/***/ "./resources/js/components/forms/SignUpForm.js":
/*!*****************************************************!*\
  !*** ./resources/js/components/forms/SignUpForm.js ***!
  \*****************************************************/
/*! exports provided: signUpFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "signUpFormFactory", function() { return signUpFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");
/* harmony import */ var _facades_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../facades/dom */ "./resources/js/facades/dom.js");



function SignUpForm(options) {
  this.fields = {
    name: document.getElementById('register-name'),
    surnames: document.getElementById('surnames'),
    email: document.getElementById('register-email'),
    phone_number: {
      prefix: document.getElementById('prefix'),
      number: document.getElementById('phone-number')
    },
    program: document.getElementById('program'),
    cv: document.getElementById('cv')
  };
  this.fieldsets = {
    industry: document.getElementById('industryFieldset'),
    study: document.getElementById('studyFieldset'),
    university: document.getElementById('universityFieldset')
  };

  this.init = function () {
    var _this = this;

    this.fields.program.addEventListener('change', function () {
      _this.updateFieldset(_this);
    }, this);
  };

  this.init();
}

var signUpFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (SignUpForm);

/***/ }),

/***/ "./resources/js/components/forms/UpgradeUserForm.js":
/*!**********************************************************!*\
  !*** ./resources/js/components/forms/UpgradeUserForm.js ***!
  \**********************************************************/
/*! exports provided: upgradeUserFormFactory, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "upgradeUserFormFactory", function() { return upgradeUserFormFactory; });
/* harmony import */ var _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../factories/FormsFactory */ "./resources/js/factories/FormsFactory.js");


function UpgradeUserForm() {
  this.fields = {};
  this.editor = null;

  this.init = function () {
    var _this = this;

    this.fields.message = this.el.querySelector('#message');
    this.editor = this.el.querySelector('#message-editor');
    this.editor = this.mountWYSIWYGEditor();
    this.el.addEventListener('submit', function (ev) {
      _this.fields.message.value = JSON.stringify(_this.editor.getContents());
    });
    return this;
  };
}

var upgradeUserFormFactory = new _factories_FormsFactory__WEBPACK_IMPORTED_MODULE_0__["FormFactory"]();
/* harmony default export */ __webpack_exports__["default"] = (UpgradeUserForm);

/***/ }),

/***/ "./resources/js/components/register.js":
/*!*********************************************!*\
  !*** ./resources/js/components/register.js ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _forms_SignUpForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./forms/SignUpForm */ "./resources/js/components/forms/SignUpForm.js");


var register = function () {
  var el = document.querySelector('main#signup');
  var signUpForm = null;

  var init = function init() {
    setListeners();
  };

  var setRegisterForm = function setRegisterForm() {
    if (document.querySelector('#signup-form') !== null) {
      signUpForm = new _forms_SignUpForm__WEBPACK_IMPORTED_MODULE_0__["signUpFormFactory"].createForm({
        type: 'sign-up',
        form: document.querySelector('#signup-form')
      });
      signUpForm.updateFieldset();
    }
  };

  var setListeners = function setListeners() {
    window.addEventListener('load', function (e) {
      setRegisterForm();
    });
  };

  init();
}();

/***/ }),

/***/ "./resources/js/components/sliders.js":
/*!********************************************!*\
  !*** ./resources/js/components/sliders.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_dom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/dom */ "./resources/js/main/dom.js");
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");
/* harmony import */ var _ArrowSlider__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ArrowSlider */ "./resources/js/components/ArrowSlider.js");
/* harmony import */ var _MediaSlider__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./MediaSlider */ "./resources/js/components/MediaSlider.js");
/* harmony import */ var _PeopleSlider__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./PeopleSlider */ "./resources/js/components/PeopleSlider.js");
/* harmony import */ var _main_api_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../main/api.js */ "./resources/js/main/api.js");







var pressNote = function pressNote() {
  var mediaSlider = null;

  function init() {
    var mediaSlider = _MediaSlider__WEBPACK_IMPORTED_MODULE_3__["mediaSliderFactory"].createSlider({
      type: 'media'
    });
  }

  init();
}; // var learnChinese = function() {
//     var arrowSlider = null;
//
//     function replaceCourseInfoSection(newCourseInfoSection) {
//         $('section#course-info').remove();
//         $('section.arrow-slider').after(newCourseInfoSection);
//     }
//
//     function init() {
//         var arrowSlider = arrowSliderFactory.createSlider({
//             type: 'arrow',
//             sections: ['in-person', 'online'],
//             controllersCallback: function (slider) {
//                 let course = slider.querySelector("input[name='study'").getAttribute('value');
//                 api.getCourseInfo(course, replaceCourseInfoSection);
//             }
//         });
//     }
//
//     init();
// };


var university = function university() {
  var arrowSlider = null;

  function replaceCourseInfoSection(newCourseInfoSection) {
    $('section#course-info').remove();
    $('section.arrow-slider').after(newCourseInfoSection);
  }

  function init() {
    var arrowSlider = _ArrowSlider__WEBPACK_IMPORTED_MODULE_2__["arrowSliderFactory"].createSlider({
      type: 'arrow',
      sections: ['mba', 'mib', 'other']
    });
  }

  init();
};

var testimonials = function testimonials() {
  var peopleSlider = null;

  function init() {
    var peopleSlider = _PeopleSlider__WEBPACK_IMPORTED_MODULE_4__["peopleSliderFactory"].createSlider({
      type: 'people',
      interval: 5000,
      duration: 550
    });
  }

  init();
};

window.addEventListener('load', function () {
  if (document.querySelector('section#press') !== null) {
    pressNote();
  } // if (document.querySelector('main#learn-chinese') !== null) {
  //     learnChinese();
  // }


  if (document.querySelector('main#university') !== null) {
    university();
  }

  if (document.querySelector('section#testimonials') !== null) {
    testimonials();
  }
});

/***/ }),

/***/ "./resources/js/facades/api.js":
/*!*************************************!*\
  !*** ./resources/js/facades/api.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



var api = function () {
  var _ = {
    routes: {
      hostname: window.location.protocol + '//' + window.location.hostname,
      offers: '/internship',
      learn: '/learn',
      payment_method: '/payment-method',
      rates: 'https://api.exchangeratesapi.io/latest?base=EUR',
      paid: '/paid',
      payments: {
        study: 'payments/study'
      }
    },
    getParams: function getParams() {
      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : window.location.search;
      var params = {};

      if (url.charAt(0) !== '?') {
        url = url.split('?', 2)[1];
      }

      url.substring(1).split('&').forEach(function (param) {
        params[param.split('=')[0]] = param.split('=')[1];
      });
      return params;
    }
  };
  return {
    jQueryGet: function jQueryGet(url) {
      var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
      var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;

      if (params !== null) {
        url = this.setLaravelParams(url, params);
      }

      console.log(url);
      $.get({
        url: url,
        cache: false,
        data: data !== null ? data : null,
        dataType: 'json',
        error: function error(xhr, status, _error) {
          console.log(_error);
        },
        success: function success(data, status, xhr) {
          if (callback !== null) {
            console.log(data);
            return callback(data);
          }

          console.log(data);
          return data;
        }
      });
    },
    setParams: function setParams(url) {
      var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      if (params.length === 0) {
        return url;
      }

      Object.keys(params).forEach(function (key, index) {
        if (params[key] !== null) {
          if (index === 0) {
            url += '?';
          }

          url = url.concat(key, '=', params[key]);
        }
      });
      return url;
    },
    validate: function () {
      var _validate = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(validationObject) {
        var validationURL;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                validationURL = '/validate/' + validationObject.name;
                _context.next = 3;
                return this.axiosRequest(validationURL, 'post', validationObject);

              case 3:
                return _context.abrupt("return", _context.sent);

              case 4:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function validate(_x) {
        return _validate.apply(this, arguments);
      }

      return validate;
    }(),
    fetchExternalApi: function fetchExternalApi(url) {
      var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      var method = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'get';
      return $.ajax({
        url: url,
        cache: false,
        data: data,
        dataType: 'json',
        error: function error(xhr, status, _error2) {
          console.log(_error2);
        }
      });
    },
    getToken: function getToken() {
      return document.head.querySelector('meta[name="csrf-token"').getAttribute('content');
    },
    axiosRequest: function () {
      var _axiosRequest = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(url) {
        var method,
            data,
            response,
            _args2 = arguments;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                method = _args2.length > 1 && _args2[1] !== undefined ? _args2[1] : 'get';
                data = _args2.length > 2 && _args2[2] !== undefined ? _args2[2] : null;
                axios__WEBPACK_IMPORTED_MODULE_1___default.a.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

                if (method === 'post') {
                  axios__WEBPACK_IMPORTED_MODULE_1___default.a.defaults.headers.common['X-CSRF-TOKEN'] = this.getToken();
                }

                _context2.prev = 4;
                _context2.next = 7;
                return axios__WEBPACK_IMPORTED_MODULE_1___default()({
                  method: method,
                  url: url,
                  data: data
                });

              case 7:
                response = _context2.sent;
                console.log(response.data);
                _context2.next = 11;
                return response.data;

              case 11:
                return _context2.abrupt("return", _context2.sent);

              case 14:
                _context2.prev = 14;
                _context2.t0 = _context2["catch"](4);

                if (!(_context2.t0.response.status === 422)) {
                  _context2.next = 19;
                  break;
                }

                console.log(_context2.t0.response.data);
                return _context2.abrupt("return", _context2.t0.response.data);

              case 19:
                _context2.next = 21;
                return _context2.t0.response;

              case 21:
                return _context2.abrupt("return", _context2.sent);

              case 22:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, this, [[4, 14]]);
      }));

      function axiosRequest(_x2) {
        return _axiosRequest.apply(this, arguments);
      }

      return axiosRequest;
    }(),
    getRoute: function getRoute(name) {
      return _.routes[name];
    },
    getResource: function getResource(resource) {
      var value = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

      if (value !== null) {
        return this.getRoute('hostname') + '/api/' + resource + '/' + value;
      }

      return this.getRoute('hostname') + '/api/' + resource;
    },
    setLaravelParams: function setLaravelParams(url) {
      var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];

      if (params.length === 0) {
        return url;
      }

      params.forEach(function (param) {
        if (param !== null) {
          url = url.concat('/', param);
        }
      });
      return url;
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (api);

/***/ }),

/***/ "./resources/js/facades/browser.js":
/*!*****************************************!*\
  !*** ./resources/js/facades/browser.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _facades_dom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../facades/dom */ "./resources/js/facades/dom.js");
/* harmony import */ var _facades_str__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../facades/str */ "./resources/js/facades/str.js");
function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }




var browser = function () {
  var _ = {
    breakpoints: {
      small: {
        media: null,
        type: 'max',
        size: 680
      },
      medium: {
        media: null,
        type: 'min',
        size: 460
      },
      large: {
        media: null,
        type: 'min',
        size: 993
      },
      navbar: {
        media: null,
        type: 'min',
        size: 992
      },
      bootstrap: {
        sm: {
          media: null,
          type: 'max',
          size: 575
        }
      },
      footer: {
        checkbox: {
          media: null,
          type: 'min',
          size: 1118
        }
      }
    },
    setBreakpoints: function setBreakpoints() {
      var breakpoints = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      if (breakpoints === null) breakpoints = _.breakpoints;
      Object.keys(breakpoints).map(function (key) {
        if (breakpoints[key].media !== undefined) {
          breakpoints[key].media = '(' + breakpoints[key].type + '-width: ' + breakpoints[key].size + 'px)';
        } else {
          this.setBreakpoints(breakpoints[key]);
        }
      }, this);
    },
    init: function init() {
      this.setBreakpoints();
    }
  };

  _.init();

  return {
    isSmallDevice: function isSmallDevice() {
      return window.matchMedia(_.breakpoints.small.media).matches;
    },
    isMediumDevice: function isMediumDevice() {
      return window.matchMedia(_.breakpoints.medium.media).matches;
    },
    isLargeDevice: function isLargeDevice() {
      return window.matchMedia(_.breakpoints.large.media).matches;
    },
    isBootstrapBreakpoint: function isBootstrapBreakpoint(breakpoint) {
      return window.matchMedia(_.breakpoints.bootstrap[breakpoint].media).matches;
    },
    matchesGivenBreakpoint: function matchesGivenBreakpoint(breakpoint) {
      if (eval('_.breakpoints.' + breakpoint) === undefined) {
        console.log("The given breakpoint name does not exist");
        return null;
      }

      return window.matchMedia(eval('_.breakpoints.' + breakpoint).media).matches;
    },
    getTotalHeightScrolled: function getTotalHeightScrolled() {
      return window.pageYOffset + window.innerHeight;
    },
    scrollSmoothlyTo: function scrollSmoothlyTo(direction, position) {
      var properties = {};
      properties['scroll' + _facades_str__WEBPACK_IMPORTED_MODULE_1__["default"].capitalizeFirst(direction)] = position;
      $("html").animate(properties, 500, 'swing');
    },
    isElementScoped: function isElementScoped(el) {
      if (_facades_dom__WEBPACK_IMPORTED_MODULE_0__["default"].isElement(el)) {
        return $(el).offset().top <= $(window).scrollTop() + window.innerHeight;
      }

      var coordinates = _typeof(el) === 'object' ? el : false;

      if (coordinates) {
        return coordinates.top <= $(window).scrollTop() + window.innerHeight;
      }
    },
    isElementScrolledIntoView: function isElementScrolledIntoView(el) {
      var viewportBottom = $(window).scrollTop() + $(window).height();

      if (_facades_dom__WEBPACK_IMPORTED_MODULE_0__["default"].isElement(el)) {
        var elBottom = $(el).offset().top + el.clientHeight;
        return elBottom >= $(window).scrollTop() && $(el).offset().top <= viewportBottom && elBottom <= viewportBottom && $(el).offset().top >= $(window).scrollTop();
      }

      var coordinates = _typeof(el) == 'object' ? el : false;

      if (coordinates) {
        return coordinates.bottom >= $(window).scrollTop() && coordinates.top <= viewportBottom && coordinates.bottom <= viewportBottom && coordinates.top >= $(window).scrollTop();
      }

      return coordinates;
    },
    isElementVisible: function isElementVisible(el) {
      if (typeof jQuery === 'function' && el instanceof jQuery) {
        el = el[0];
      }

      var rect = el.getBoundingClientRect();
      return this.getTotalHeightScrolled() >= rect.top;
    },
    isElementInViewport: function isElementInViewport(el) {
      if (typeof jQuery === 'function' && el instanceof jQuery) {
        el = el[0];
      }

      var rect = el.getBoundingClientRect();
      return rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && rect.right <= (window.innerWidth || document.documentElement.clientWidth);
    },

    /**
     * Scrolls the window until the given element reaches
     * the bottom of the navbar.
     */
    verticalScrollTo: function verticalScrollTo(element) {
      // Check if the navbar exist
      if ($('nav').length > 0) {
        $(window).scrollTop(element.clientHeight - $('nav').height());
      }
    },
    preventScrolling: function preventScrolling() {
      var position = $(document).scrollTop();
      setTimeout(function () {
        window.scrollTo(0, position);
      }, 0);
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (browser);

/***/ }),

/***/ "./resources/js/facades/dom.js":
/*!*************************************!*\
  !*** ./resources/js/facades/dom.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _browser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./browser */ "./resources/js/facades/browser.js");
function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }



var dom = function () {
  var _ = {
    isNodeList: function isNodeList(nodes) {
      return NodeList.prototype.isPrototypeOf(nodes);
    },
    // Returns true if is a HTMLCollection
    isHTMLCollection: function isHTMLCollection(collection) {
      return HTMLCollection.prototype.isPrototypeOf(collection);
    }
  };
  return {
    toggleVisibility: function toggleVisibility(element) {
      if (element.style.display === "none") {
        this.show(element);
      } else {
        this.hide(element);
      }
    },
    hide: function hide(elements) {
      var element = null;

      if (elements === null) {
        return false;
      } // Check if the element is not iterable


      if (elements == null || typeof elements[Symbol.iterator] !== 'function') {
        element = elements;
      }

      if (element !== null) {
        element.style.display = 'none';

        if (element.hasAttribute('aria-hidden')) {
          element.setAttribute('aria-hidden', 'true');
        }

        return this;
      }

      for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = 'none';

        if (elements[i].hasAttribute('aria-hidden')) {
          elements[i].setAttribute('aria-hidden', 'true');
        }
      }

      return this;
    },
    show: function show(elements) {
      var displayValue = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'block';
      var element = null;

      if (elements === null) {
        return false;
      } // Check if the element is not iterable


      if (elements == null || typeof elements[Symbol.iterator] !== 'function') {
        element = elements;
      }

      if (element !== null) {
        element.style.display = element.style.display === 'none' ? '' : element.style.display;

        if (element.hasAttribute('aria-hidden')) {
          element.setAttribute('aria-hidden', 'false');
        }

        return this;
      }

      for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = elements[i].style.display === 'none' ? '' : elements[i].style.display;

        if (elements[i].hasAttribute('aria-hidden')) {
          elements[i].setAttribute('aria-hidden', 'false');
        }
      }

      return this;
    },
    clearContent: function clearContent(element) {
      element.textContent ? element.textContent = '' : element.innerText = '';
      return this;
    },
    replaceElements: function replaceElements(replacement, replaced) {},
    // Returns true if it is a DOM node
    isNode: function isNode(obj) {
      return (typeof Node === "undefined" ? "undefined" : _typeof(Node)) === 'object' ? obj instanceof Node : obj && _typeof(obj) === 'object' && typeof obj.nodeType === 'number' && typeof obj.nodeName === 'string';
    },
    // Returns true if it is a DOM element
    isElement: function isElement(obj) {
      return (typeof HTMLElement === "undefined" ? "undefined" : _typeof(HTMLElement)) === 'object' ? obj instanceof HTMLElement : // DOM Level 2
      obj && _typeof(obj) === 'object' && true && obj.nodeType === 1 && typeof obj.nodeName === 'string';
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (dom);

/***/ }),

/***/ "./resources/js/facades/money.js":
/*!***************************************!*\
  !*** ./resources/js/facades/money.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./api */ "./resources/js/facades/api.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



var money = function () {
  var _ = {};
  return {
    getRates: function getRates() {
      return _api__WEBPACK_IMPORTED_MODULE_1__["default"].fetchExternalApi(_api__WEBPACK_IMPORTED_MODULE_1__["default"].getRoute('rates'));
    },
    exchangeCurrency: function () {
      var _exchangeCurrency = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(value, to) {
        var from,
            rates,
            _args = arguments;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                from = _args.length > 2 && _args[2] !== undefined ? _args[2] : 'EUR';
                _context.next = 3;
                return this.getRates().then(function (response) {
                  return response.rates;
                });

              case 3:
                rates = _context.sent;

                if (!(to.toUpperCase() !== 'EUR')) {
                  _context.next = 6;
                  break;
                }

                return _context.abrupt("return", value * rates[to.toUpperCase()]);

              case 6:
                return _context.abrupt("return", value);

              case 7:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function exchangeCurrency(_x, _x2) {
        return _exchangeCurrency.apply(this, arguments);
      }

      return exchangeCurrency;
    }()
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (money);

/***/ }),

/***/ "./resources/js/facades/object.js":
/*!****************************************!*\
  !*** ./resources/js/facades/object.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var object = function () {
  return {
    arrayValues: function arrayValues(obj, value) {
      var objArray = [];

      for (var i = 0; i < obj.length; i++) {
        objArray.push(obj[i][value]);
      }

      return objArray;
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (object);

/***/ }),

/***/ "./resources/js/facades/pagination.js":
/*!********************************************!*\
  !*** ./resources/js/facades/pagination.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _browser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./browser */ "./resources/js/facades/browser.js");
/* harmony import */ var _dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./dom */ "./resources/js/facades/dom.js");



var pagination = function () {
  var _ = {
    container: null,
    links: null,
    prevButton: null,
    nextButton: null,
    init: function init(args) {
      this.container = args.container;
      this.links = this.container.getElementsByClassName('items-pagination__link');
      this.offset = 1;
      this.currentPageLink = this.container.querySelector('.active');
      this.prevButton = this.container.querySelector('a[rel=\'prev\'');
      this.nextButton = this.container.querySelector('a[rel=\'next\'');
      this.splitters = this.container.getElementsByClassName('items-pagination__link--splitter');
      this.isExtendedPagination = true;
      this.setup();
    },
    setup: function setup() {
      var _this = this;

      this.getNonActivePageLinks(this.currentPageLink);
      this.addEvent(window, 'load', function () {
        _this.setResponsive(_this);
      });
      this.addEvent(window, 'resize', function () {
        _this.setResponsive(_this);
      });
    },
    getNonActivePageLinks: function getNonActivePageLinks(link) {
      var pageLinks = [];

      for (var i = 1; i < this.links.length - 1; i++) {
        if (!this.links[i].isEqualNode(link)) {
          pageLinks.push(this.links[i]);
        }
      }

      return pageLinks;
    },
    setExtendedPagination: function setExtendedPagination(value) {
      this.isExtendedPagination = value;
    },
    setResponsive: function setResponsive() {
      var self = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this;

      if (_browser__WEBPACK_IMPORTED_MODULE_0__["default"].isMediumDevice()) {
        if (this.isExtendedPagination) {
          this.showSimplePagination().setExtendedPagination(false);
        }

        return this;
      }

      if (!this.isExtendedPagination) {
        this.showExtendedPagination().setExtendedPagination(true);
      }

      return true;
    },
    showExtendedPagination: function showExtendedPagination() {
      // dom.show(this.getNonActivePageLinks(this.currentPageLink))
      //
      // if (this.nextButton !== null) dom.show(this.nextButton.querySelector('span'), 'initial');
      // if (this.prevButton !== null) dom.show(this.prevButton.querySelector('span'), 'initial');
      return this;
    },
    showSimplePagination: function showSimplePagination() {
      // dom.hide(this.getNonActivePageLinks(this.currentPageLink));
      //
      // if (this.nextButton !== null) dom.hide(this.nextButton.querySelector('span'), 'initial');
      // if (this.prevButton !== null) dom.hide(this.prevButton.querySelector('span'), 'initial');
      return this;
    },
    addEvent: function addEvent(el, event, fn) {
      if (el.addEventListener) {
        el.addEventListener(event, fn, false);
      } else if (el.attachEvent) {
        el.attachEvent("on" + event, fn);
      } else {
        el["on" + event] = fn;
      }
    }
  };
  return {
    paginate: function paginate(args) {
      _.init(args);
    },
    hasPagination: function hasPagination() {
      return document.querySelector('.items-pagination') !== null;
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (pagination);

/***/ }),

/***/ "./resources/js/facades/str.js":
/*!*************************************!*\
  !*** ./resources/js/facades/str.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var str = function () {
  var _ = {
    init: function init() {}
  };

  _.init();

  return {
    convertToString: function convertToString(str) {
      if (str) {
        if (typeof str === 'string') {
          return str;
        }

        return String(str);
      }

      return null;
    },
    toWords: function toWords(str) {
      str = this.convertToString(str);
      var regexp = /[A-Z\xC0-\xD6\xD8-\xDE]?[a-z\xDF-\xF6\xF8-\xFF]+|[A-Z\xC0-\xD6\xD8-\xDE]+(?![a-z\xDF-\xF6\xF8-\xFF])|\d+/g;
      return str.match(regexp);
    },
    titleCase: function titleCase(str) {
      var result = '';

      for (var i = 0, words = this.toWords(str); i < this.toWords(str).length; i++) {
        var currentStr = words[i].substr(0, 1).toUpperCase() + words[i].substr(1);

        if (i !== words.length - 1) {
          currentStr += '';
        }

        result += currentStr;
      }

      return result;
    },
    camelCase: function camelCase(str) {
      var result = "";

      for (var i = 0, words = this.toWords(str); i < this.toWords(str).length; i++) {
        var currentStr = words[i];
        var tempStr = currentStr.toLowerCase();

        if (i !== 0) {
          tempStr = tempStr.substr(0, 1).toUpperCase() + tempStr.substr(1);
        }

        result += tempStr;
      }

      return result; // return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
      //     return index === 0 ? word.toLowerCase() : word.toUpperCase();
      // }).replace(/\s+|_*/g, '');
    },
    kebabCase: function kebabCase(str) {
      return str.replace(/\s+/g, '-').toLowerCase();
    },
    capitalizeFirst: function capitalizeFirst(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (str);

/***/ }),

/***/ "./resources/js/factories/CardsFactory.js":
/*!************************************************!*\
  !*** ./resources/js/factories/CardsFactory.js ***!
  \************************************************/
/*! exports provided: CardsFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "CardsFactory", function() { return CardsFactory; });
/* harmony import */ var _components_MediaCards__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/MediaCards */ "./resources/js/components/MediaCards.js");

function CardsFactory() {}
CardsFactory.prototype.cardClass = null;

CardsFactory.prototype.createCard = function (options) {
  switch (options.type) {
    case 'media':
      this.cardClass = _components_MediaCards__WEBPACK_IMPORTED_MODULE_0__["default"];
      break;
  }

  ;
  var cardClass = new this.cardClass(options);
  cardClass.el = options.el;
  cardClass.form = options.form !== null ? options.form : null;
  return cardClass;
};

/***/ }),

/***/ "./resources/js/factories/CounterFactory.js":
/*!**************************************************!*\
  !*** ./resources/js/factories/CounterFactory.js ***!
  \**************************************************/
/*! exports provided: CounterFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "CounterFactory", function() { return CounterFactory; });
/* harmony import */ var _components_Counter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/Counter */ "./resources/js/components/Counter.js");

function CounterFactory() {}
CounterFactory.prototype.counterClass = null;

CounterFactory.prototype.createCounter = function (options) {
  this.counterClass = _components_Counter__WEBPACK_IMPORTED_MODULE_0__["default"];
  var counterClass = new this.counterClass(options);
  counterClass.container = options.el;
  return counterClass;
};

/***/ }),

/***/ "./resources/js/factories/DialogsFactory.js":
/*!**************************************************!*\
  !*** ./resources/js/factories/DialogsFactory.js ***!
  \**************************************************/
/*! exports provided: DialogFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "DialogFactory", function() { return DialogFactory; });
/* harmony import */ var _components_Dialog__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/Dialog */ "./resources/js/components/Dialog.js");

function DialogFactory() {}
DialogFactory.prototype.dialogClass = null;

DialogFactory.prototype.createDialog = function (options) {
  this.dialogClass = document.getElementById('dialog-box') !== null ? _components_Dialog__WEBPACK_IMPORTED_MODULE_0__["default"] : null;
  return this.dialogClass !== null ? new this.dialogClass(options) : null;
};

/***/ }),

/***/ "./resources/js/factories/FiltersFactory.js":
/*!**************************************************!*\
  !*** ./resources/js/factories/FiltersFactory.js ***!
  \**************************************************/
/*! exports provided: FilterFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "FilterFactory", function() { return FilterFactory; });
/* harmony import */ var _components_filters_IndustryFilter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/filters/IndustryFilter */ "./resources/js/components/filters/IndustryFilter.js");
/* harmony import */ var _components_filters_Searchbox__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/filters/Searchbox */ "./resources/js/components/filters/Searchbox.js");
/* harmony import */ var _components_filters_UserStatusFilter__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/filters/UserStatusFilter */ "./resources/js/components/filters/UserStatusFilter.js");



function FilterFactory() {}
FilterFactory.prototype.filterClass = null;

FilterFactory.prototype.createFilter = function (options) {
  switch (options.type) {
    case 'industry':
      this.filterClass = _components_filters_IndustryFilter__WEBPACK_IMPORTED_MODULE_0__["default"];
      break;

    case 'search':
      this.filterClass = _components_filters_Searchbox__WEBPACK_IMPORTED_MODULE_1__["default"];
      break;

    case 'user-status':
      this.filterClass = _components_filters_UserStatusFilter__WEBPACK_IMPORTED_MODULE_2__["default"];
  }

  ;
  return new this.filterClass(options);
};

/***/ }),

/***/ "./resources/js/factories/FormsFactory.js":
/*!************************************************!*\
  !*** ./resources/js/factories/FormsFactory.js ***!
  \************************************************/
/*! exports provided: FormFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "FormFactory", function() { return FormFactory; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_forms_ContactForm__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/forms/ContactForm */ "./resources/js/components/forms/ContactForm.js");
/* harmony import */ var _components_forms_CreateOfferForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/forms/CreateOfferForm */ "./resources/js/components/forms/CreateOfferForm.js");
/* harmony import */ var _components_forms_DeleteOfferForm__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../components/forms/DeleteOfferForm */ "./resources/js/components/forms/DeleteOfferForm.js");
/* harmony import */ var _components_forms_DeleteUserForm__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../components/forms/DeleteUserForm */ "./resources/js/components/forms/DeleteUserForm.js");
/* harmony import */ var _components_forms_DeleteFeeForm__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../components/forms/DeleteFeeForm */ "./resources/js/components/forms/DeleteFeeForm.js");
/* harmony import */ var _components_forms_EditFeeForm__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../components/forms/EditFeeForm */ "./resources/js/components/forms/EditFeeForm.js");
/* harmony import */ var _components_forms_EditOfferForm__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../components/forms/EditOfferForm */ "./resources/js/components/forms/EditOfferForm.js");
/* harmony import */ var _components_forms_EditUserForm__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../components/forms/EditUserForm */ "./resources/js/components/forms/EditUserForm.js");
/* harmony import */ var _components_forms_UpgradeUserForm__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../components/forms/UpgradeUserForm */ "./resources/js/components/forms/UpgradeUserForm.js");
/* harmony import */ var _components_forms_LoginForm__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../components/forms/LoginForm */ "./resources/js/components/forms/LoginForm.js");
/* harmony import */ var _components_forms_ProceedPaymentForm__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../components/forms/ProceedPaymentForm */ "./resources/js/components/forms/ProceedPaymentForm.js");
/* harmony import */ var _components_forms_PaymentForm__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../components/forms/PaymentForm */ "./resources/js/components/forms/PaymentForm.js");
/* harmony import */ var _components_forms_SignUpForm__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../components/forms/SignUpForm */ "./resources/js/components/forms/SignUpForm.js");
/* harmony import */ var _main_UI__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ../main/UI */ "./resources/js/main/UI.js");
/* harmony import */ var _facades_dom__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ../facades/dom */ "./resources/js/facades/dom.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ../facades/api */ "./resources/js/facades/api.js");
/* harmony import */ var _components_forms_CreateFeeForm__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ../components/forms/CreateFeeForm */ "./resources/js/components/forms/CreateFeeForm.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


















function FormFactory() {}
FormFactory.prototype.formClass = null;

FormFactory.prototype.createForm = function (options) {
  switch (options.type) {
    case 'contact':
      this.formClass = _components_forms_ContactForm__WEBPACK_IMPORTED_MODULE_1__["default"];
      break;

    case 'sign-up':
      this.formClass = _components_forms_SignUpForm__WEBPACK_IMPORTED_MODULE_13__["default"];
      break;

    case 'proceed-payment':
      this.formClass = _components_forms_ProceedPaymentForm__WEBPACK_IMPORTED_MODULE_11__["default"];
      break;

    case 'payment':
      this.formClass = _components_forms_PaymentForm__WEBPACK_IMPORTED_MODULE_12__["default"];
      break;

    case 'login':
      this.formClass = _components_forms_LoginForm__WEBPACK_IMPORTED_MODULE_10__["default"];
      break;

    case 'create-offer':
      this.formClass = _components_forms_CreateOfferForm__WEBPACK_IMPORTED_MODULE_2__["default"];
      break;

    case 'edit-fee':
      this.formClass = _components_forms_EditFeeForm__WEBPACK_IMPORTED_MODULE_6__["default"];
      break;

    case 'edit-offer':
      this.formClass = _components_forms_EditOfferForm__WEBPACK_IMPORTED_MODULE_7__["default"];
      break;

    case 'delete-offer':
      this.formClass = _components_forms_DeleteOfferForm__WEBPACK_IMPORTED_MODULE_3__["default"];
      break;

    case 'delete-user':
      this.formClass = _components_forms_DeleteUserForm__WEBPACK_IMPORTED_MODULE_4__["default"];
      break;

    case 'upgrade-user':
      this.formClass = _components_forms_UpgradeUserForm__WEBPACK_IMPORTED_MODULE_9__["default"];
      break;

    case 'create-fee':
      this.formClass = _components_forms_CreateFeeForm__WEBPACK_IMPORTED_MODULE_17__["default"];
      break;

    case 'delete-fee':
      this.formClass = _components_forms_DeleteFeeForm__WEBPACK_IMPORTED_MODULE_5__["default"];
      break;

    case 'edit-user':
      this.formClass = _components_forms_EditUserForm__WEBPACK_IMPORTED_MODULE_8__["default"];
      break;
  }

  var formClass = new this.formClass(options);
  formClass.el = options.form;
  formClass.disabled = false;
  formClass.filters = {
    "float": /^-?\d*[.,]?\d*$/,
    integer: /^-?\d*$/
  };

  formClass.hasErrorMessages = function () {
    var element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : formClass.el;
    return $(element).find('.invalid-feedback').length > 0 && $(element).find('.is-invalid').length > 0;
  };

  formClass.isInvalidField = function (field) {
    return $(field).hasClass('is-invalid');
  };

  formClass.focusFirstInvalidField = function () {
    Object.keys(formClass.fields).forEach(function (key) {
      if (formClass.hasErrorMessages(formClass.fields[key]) || formClass.isInvalidField(formClass.fields[key])) {
        formClass.fields[key].focus();
        return formClass;
      }
    });
    return formClass;
  };

  formClass.setItemAction = function (input) {
    var id = input.getAttribute('data-value') !== null ? input.getAttribute('data-value') : $(input).parents('button[data-value], a[data-value]')[0].getAttribute('data-value');
    var url = new URL(this.el.action);
    var oldPathname = url.pathname.split('/');
    var newPathname = '';

    for (var i = 1; i < oldPathname.length; i++) {
      newPathname += i === oldPathname.length - 1 ? '/' + id : '/' + oldPathname[i];
    }

    this.el.action = url.origin + newPathname;
  };

  formClass.getActionUrl = function () {
    return formClass.el.getAttribute('action');
  };

  formClass.getSelectedProgram = function () {
    if (typeof this.fields.program === 'undefined') {
      return null;
    }

    return this.fields.program.options[this.fields.program.selectedIndex].value;
  };

  formClass.updateFieldset = function () {
    var self = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this;

    switch (self.getSelectedProgram()) {
      case 'internship':
      case 'inter_relocat':
        if (self.fields.cv) {
          _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].show(self.fields.cv.parentElement.parentElement, 'flex');
        }

        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].show(self.fieldsets.industry, 'flex');
        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].hide(self.fieldsets.university);
        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].hide(self.fieldsets.study);
        break;

      case 'study':
        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].show(self.fieldsets.study, 'flex');

        if (self.fields.cv) {
          _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].hide(self.fields.cv.parentElement.parentElement);
        }

        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].hide(self.fieldsets.industry);
        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].hide(self.fieldsets.university);
        break;

      case 'university':
        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].show(self.fieldsets.university, 'flex');

        if (self.fields.cv) {
          _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].show(self.fields.cv.parentElement.parentElement, 'flex');
        }

        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].hide(self.fieldsets.study);
        _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].hide(self.fieldsets.industry);
        break;

      default:
        return null;
        break;
    }
  };

  formClass.toggleLoadingState = function () {
    _main_UI__WEBPACK_IMPORTED_MODULE_14__["default"].toggleSpinnerButtonState(formClass.getSubmitInput());
    formClass.disable(!formClass.isDisabled());
    return formClass;
  };

  formClass.getSubmitInput = function () {
    return $(formClass.el).find("button[type='submit']")[0];
  };

  formClass.toggleInputs = function (elements) {
    elements.forEach(function (element) {
      var input = element.localName !== 'input' ? element.querySelector('input') : element;

      if (!$(input).hasClass('form-group')) {
        $($(input).parents('.form-group')[0]).toggleClass('hidden');
      }
    });
  };

  formClass.mountWYSIWYGEditor = function () {
    if (this.editor !== undefined) {
      return new Quill(this.el.querySelector('.editor'), {
        modules: {
          toolbar: [[{
            header: [3, 4, 5, false]
          }], ['bold', 'italic', 'underline'], [{
            'list': 'ordered'
          }, {
            'list': 'bullet'
          }, 'blockquote'], [{
            'indent': '-1'
          }, {
            'indent': '+1'
          }, 'link', 'code-block']]
        },
        placeholder: this.editor.getAttribute('data-value'),
        theme: 'snow'
      });
    }
  };

  formClass.isDisabled = function () {
    return formClass.disabled;
  };

  formClass.validateField =
  /*#__PURE__*/
  function () {
    var _ref = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(field, validators) {
      var _this = this;

      var validationObject, response, errors;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              validationObject = {
                name: field.getAttribute('name'),
                value: field.value,
                validators: validators
              };
              _context.next = 3;
              return _facades_api__WEBPACK_IMPORTED_MODULE_16__["default"].validate(validationObject);

            case 3:
              response = _context.sent;

              if (!response.errors) {
                _context.next = 8;
                break;
              }

              errors = response.errors.value;
              errors.forEach(function (error) {
                _this.displayFieldError(field, error);
              });
              return _context.abrupt("return", this);

            case 8:
              this.removeFieldError(field);

            case 9:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, this);
    }));

    return function (_x, _x2) {
      return _ref.apply(this, arguments);
    };
  }();

  formClass.displayFieldError = function (field, message) {
    $(field).addClass('is-invalid');
    $($(field).parents('.form-group')[0]).find('.invalid-feedback').text(message).css('display', 'block');
  };

  formClass.removeFieldError = function (field) {
    if ($(field).hasClass('is-invalid')) {
      $(field).removeClass('is-invalid');
    }

    $($(field).parents('.form-group')[0]).find('.invalid-feedback').empty();
  };

  formClass.disable = function () {
    var disabled = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    $('input:not(.__PrivateStripeElement-input), select, button, fieldset', formClass.el).each(function (index, element) {
      $(element).prop('disabled', disabled);
    });
    formClass.disabled = !formClass.isDisabled();
  };

  formClass.setInputFilter = function (textbox, inputFilter) {
    var inputEvents = ['input', 'keydown', 'keyup', 'mousedown', 'mouseup', 'select', 'contextmenu', 'drop'];
    inputEvents.forEach(function (event) {
      textbox.addEventListener(event, function () {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    });
  };

  formClass.previewUploadedFiles = function () {
    var previews = formClass.el.querySelectorAll('.c-file-input__img-preview');

    var _loop = function _loop(i) {
      var input = $(previews[i]).next('.c-file-input');
      $(input).on('click touchstart', function () {
        $(this).val('');
      });
      $(input).change(function (ev) {
        $(previews[i]).attr('src', URL.createObjectURL(ev.target.files.item(0)));
        console.log(previews[i].style.display);

        if (previews[i].style.display === 'none') {
          _facades_dom__WEBPACK_IMPORTED_MODULE_15__["default"].show(previews[i]);
        }
      });
    };

    for (var i = 0; i <= previews.length; i++) {
      _loop(i);
    }

    return formClass;
  };

  return formClass;
};

/***/ }),

/***/ "./resources/js/factories/GridsFactory.js":
/*!************************************************!*\
  !*** ./resources/js/factories/GridsFactory.js ***!
  \************************************************/
/*! exports provided: GridFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "GridFactory", function() { return GridFactory; });
/* harmony import */ var _components_SquareGrid__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/SquareGrid */ "./resources/js/components/SquareGrid.js");

function GridFactory() {}
GridFactory.prototype.gridClass = null;

GridFactory.prototype.createGrid = function (options) {
  if (options.el.classList.contains('square-grid')) {
    this.gridClass = _components_SquareGrid__WEBPACK_IMPORTED_MODULE_0__["default"];
  }

  var gridClass = new this.gridClass(options);
  gridClass.el = options.el;
  return gridClass;
};

/***/ }),

/***/ "./resources/js/factories/InfographyFactory.js":
/*!*****************************************************!*\
  !*** ./resources/js/factories/InfographyFactory.js ***!
  \*****************************************************/
/*! exports provided: InfographyFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "InfographyFactory", function() { return InfographyFactory; });
/* harmony import */ var _components_Infography__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/Infography */ "./resources/js/components/Infography.js");

function InfographyFactory() {}
;
InfographyFactory.prototype.infographyClass = _components_Infography__WEBPACK_IMPORTED_MODULE_0__["default"];

InfographyFactory.prototype.createInfography = function (options) {
  this.infographyClass = _components_Infography__WEBPACK_IMPORTED_MODULE_0__["default"];
  var infographyClass = new this.infographyClass(options);
  infographyClass.el = options.el;
  return infographyClass;
};

/***/ }),

/***/ "./resources/js/factories/ListFactory.js":
/*!***********************************************!*\
  !*** ./resources/js/factories/ListFactory.js ***!
  \***********************************************/
/*! exports provided: ListFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ListFactory", function() { return ListFactory; });
/* harmony import */ var _components_AccordionList__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/AccordionList */ "./resources/js/components/AccordionList.js");

function ListFactory() {}
ListFactory.prototype.listClass = null;

ListFactory.prototype.createList = function (options) {
  switch (options.type) {
    case 'accordion':
      this.listClass = _components_AccordionList__WEBPACK_IMPORTED_MODULE_0__["default"];
      break;
  }

  var listClass = new this.listClass(options);
  listClass.el = options.el;
  listClass.form = options.form !== null ? options.form : null;
  return listClass;
};

/***/ }),

/***/ "./resources/js/factories/ModalsFactory.js":
/*!*************************************************!*\
  !*** ./resources/js/factories/ModalsFactory.js ***!
  \*************************************************/
/*! exports provided: ModalFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ModalFactory", function() { return ModalFactory; });
/* harmony import */ var _components_Modal__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/Modal */ "./resources/js/components/Modal.js");

function ModalFactory() {}
;
ModalFactory.prototype.modalClass = null;

ModalFactory.prototype.createModal = function (options) {
  this.modalClass = options.el !== null ? _components_Modal__WEBPACK_IMPORTED_MODULE_0__["default"] : null;
  return this.modalClass !== null ? new this.modalClass(options) : null;
};

/***/ }),

/***/ "./resources/js/factories/NavigationFactory.js":
/*!*****************************************************!*\
  !*** ./resources/js/factories/NavigationFactory.js ***!
  \*****************************************************/
/*! exports provided: NavigationFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "NavigationFactory", function() { return NavigationFactory; });
/* harmony import */ var _components_BottomNavigation__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/BottomNavigation */ "./resources/js/components/BottomNavigation.js");

function NavigationFactory() {}
NavigationFactory.prototype.navigationClass = null;

NavigationFactory.prototype.createNavigation = function (options) {
  switch (options.type) {
    case 'bottom':
      this.navigationClass = _components_BottomNavigation__WEBPACK_IMPORTED_MODULE_0__["default"];
      break;
  }

  var navigationClass = new this.navigationClass(options);
  navigationClass.el = options.el;
  return navigationClass;
};

/***/ }),

/***/ "./resources/js/factories/SliderFactory.js":
/*!*************************************************!*\
  !*** ./resources/js/factories/SliderFactory.js ***!
  \*************************************************/
/*! exports provided: SliderFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "SliderFactory", function() { return SliderFactory; });
/* harmony import */ var _components_ArrowSlider__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/ArrowSlider */ "./resources/js/components/ArrowSlider.js");
/* harmony import */ var _components_MediaSlider__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/MediaSlider */ "./resources/js/components/MediaSlider.js");
/* harmony import */ var _components_PeopleSlider__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/PeopleSlider */ "./resources/js/components/PeopleSlider.js");



function SliderFactory() {}
SliderFactory.prototype.sliderClass = _components_ArrowSlider__WEBPACK_IMPORTED_MODULE_0__["default"];

SliderFactory.prototype.createSlider = function (options) {
  switch (options.type) {
    case 'arrow':
      this.sliderClass = _components_ArrowSlider__WEBPACK_IMPORTED_MODULE_0__["default"];
      break;

    case 'media':
      this.sliderClass = _components_MediaSlider__WEBPACK_IMPORTED_MODULE_1__["default"];
      break;

    case 'people':
      this.sliderClass = _components_PeopleSlider__WEBPACK_IMPORTED_MODULE_2__["default"];
      break;
  }

  return new this.sliderClass(options);
};

/***/ }),

/***/ "./resources/js/factories/TableFactory.js":
/*!************************************************!*\
  !*** ./resources/js/factories/TableFactory.js ***!
  \************************************************/
/*! exports provided: TableFactory */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TableFactory", function() { return TableFactory; });
/* harmony import */ var _components_FlexTable_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/FlexTable.js */ "./resources/js/components/FlexTable.js");

function TableFactory() {}
TableFactory.prototype.tableClass = null;

TableFactory.prototype.createTable = function (options) {
  switch (options.type) {
    case 'flex':
      this.tableClass = _components_FlexTable_js__WEBPACK_IMPORTED_MODULE_0__["default"];
      break;
  }

  var tableClass = new this.tableClass(options);
  tableClass.el = options.el !== null ? options.el : null;
  tableClass.form = options.form !== null ? options.form : null;
  return tableClass;
};

/***/ }),

/***/ "./resources/js/main/Forms.js":
/*!************************************!*\
  !*** ./resources/js/main/Forms.js ***!
  \************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var Forms = function () {
  var instance;

  function init() {
    var _preventInputFocus = function _preventInputFocus(event) {
      if (!window.__cfRLUnblockHandlers) return false;
    };

    return {
      // Disables the custom inputs of the form (All but the Stripe inputs)
      disableFormInputs: function disableFormInputs(form) {
        var disabled = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
        $(form).filter(function () {
          if (disabled) {
            return $('input:not(.__PrivateStripeElement-input), select, button', this).attr("disabled", disabled);
          }

          $('input:not(.__PrivateStripeElement-input), select, button', this).removeAttr('disabled');
        });
      },
      showElement: function showElement(element) {
        element.classList.remove('hidden');
        element.setAttribute('aria-hidden', false);
      },
      hideElement: function hideElement(element) {
        element.classList.add('hidden');
        element.setAttribute('aria-hidden', true);
      },
      // Disables all the Stripe inputs of the form.
      disableStripeInputs: function disableStripeInputs(stripeElements) {
        var disabled = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
        stripeElements.forEach(function (element) {
          element.update({
            disabled: disabled
          });
        });
      },
      getFormToken: function getFormToken(form) {
        return form.querySelector('input[type="hidden"');
      },
      toggleDisablingForm: function toggleDisablingForm(form) {
        var _this = this;

        var submitButton = form.querySelector('button[type=submit]');
        $(submitButton).one('click', function (event) {
          if (submitButton.getAttribute('disabled') !== true) {
            $(_this).prop('disabled', true);
            $(form).submit(false);
          } else {
            $(_this).prop('disabled', false);
            $(form).submit(true);
          }
        });
      },
      preventDoubleClick: function preventDoubleClick(form) {
        var submitButton = form.querySelector('button[type=submit]');
        $(submitButton).one('click', function (event) {
          var _this2 = this;

          $(this).prop('disabled', true);
          setTimeout(function () {
            $(_this2).prop('disabled', false);
          }, 1000);
        });
      },
      toggleInputs: function toggleInputs(value, elements) {
        var _this3 = this;

        Object.keys(elements).forEach(function (key) {
          var element = elements[key][0];
          var input = element.localName !== 'input' ? element.querySelector('input') : element;
          $(input).prop('disabled', true);

          _this3.hideElement(element);

          if (key === value) {
            $(input).prop('disabled', false);

            _this3.showElement(element);
          }
        });
      }
    };
  }

  return {
    getInstance: function getInstance() {
      if (!instance) {
        instance = init();
      }

      return instance;
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (Forms.getInstance());

/***/ }),

/***/ "./resources/js/main/Money.js":
/*!************************************!*\
  !*** ./resources/js/main/Money.js ***!
  \************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./api */ "./resources/js/main/api.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



var Money = function () {
  var instance;

  function MoneyClass(currencies) {
    // Private properties
    var _ratesURL = 'https://reqres.in/api/users?page=2';
    var rates = null;

    function init() {
      return _init.apply(this, arguments);
    }

    function _init() {
      _init = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _getRates().then(function (response) {
                  console.log(response.data);
                })["catch"](function (error) {
                  console.log(error.response);
                });

              case 1:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }));
      return _init.apply(this, arguments);
    }

    function _getRates() {
      return _getRates2.apply(this, arguments);
    }

    function _getRates2() {
      _getRates2 = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.next = 2;
                return axios.get(_ratesURL, {
                  crossDomain: true
                });

              case 2:
                return _context2.abrupt("return", _context2.sent);

              case 3:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }));
      return _getRates2.apply(this, arguments);
    }

    ;
    init();
    return {
      currencies: currencies,
      rates: rates,
      currencyExchange: function currencyExchange(value, to) {
        var from = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'EUR';
        to = to.upperCase();

        if (to !== from) {
          value *= this.rates[to];
        }

        return value;
      }
    };
  }

  return {
    getInstance: function getInstance() {
      if (!instance) {
        instance = MoneyClass;
      }

      return instance;
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (Money.getInstance());

/***/ }),

/***/ "./resources/js/main/UI.js":
/*!*********************************!*\
  !*** ./resources/js/main/UI.js ***!
  \*********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _dom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./dom */ "./resources/js/main/dom.js");
/* harmony import */ var _breakpoints__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./breakpoints */ "./resources/js/main/breakpoints.js");



var UI = function () {
  var instance;

  function init() {
    // Private properties
    var patterns = {
      verticalCustomerJourney: /vertical.(png|jpg|gif)$/g,
      horizontalCustomerJourney: /horizontal.(png|jpg|gif)$/g
    }; // Private methods

    return {
      get: function get(key) {
        return eval(key);
      },
      getPattern: function getPattern(name) {
        return patterns[name];
      },
      getLocale: function getLocale() {
        return document.querySelector('html').getAttribute('lang');
      },
      getCustomerJourneyPicture: function getCustomerJourneyPicture(customerJourney) {
        if (_breakpoints__WEBPACK_IMPORTED_MODULE_1__["default"].isCustomerJourney() && !$(customerJourney).hasClass('customer-journey')) {
          _dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(customerJourney, 'customer-journey--mobile');
          return {
            className: 'customer-journey',
            src: 'horizontal'
          };
        }

        if (!_breakpoints__WEBPACK_IMPORTED_MODULE_1__["default"].isCustomerJourney() && !$(customerJourney).hasClass('customer-journey--mobile')) {
          _dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(customerJourney, 'customer-journey');
          return {
            className: 'customer-journey--mobile',
            src: 'vertical'
          };
        }

        return null;
      },
      upperCaseFirst: function upperCaseFirst(string) {
        var indexSecondCharacter = 1;
        return string.toUpperCase().charAt(0) + string.slice(indexSecondCharacter, string.length);
      },
      getInputClass: function getInputClass(input) {
        if ($(input).has('.switch')) {
          if (_breakpoints__WEBPACK_IMPORTED_MODULE_1__["default"].isLargeDevice() && !$(input).hasClass('checkbox_input')) {
            return 'checkbox_input';
          }

          if (!_breakpoints__WEBPACK_IMPORTED_MODULE_1__["default"].isLargeDevice() && !$(input).hasClass('switch_input')) {
            return 'switch_input';
          }

          return null;
        }

        ; // if (MediaQueries.isLargeDevice()) {
        //
        //     // Transforms the switch input into a checkbox
        //     if (!$(input).hasClass('switch_input')) {
        //         DOM.toggleClass(input,'switch_input', 'checkbox_input');
        //     }
        //
        // } else {
        //     console.log($(input).hasClass('switch_input'));
        //
        //     // Transforms the checkbox input into a switch button
        //     if ($(input).hasClass('checkbox_input')) {
        //         DOM.toggleClass(input, 'switch_input', 'checkbox_input');
        //     }
        //
        // }
      },
      toggleSpinnerButtonState: function toggleSpinnerButtonState(button) {
        var spinner = button.querySelector('.spinner-border');

        if (spinner !== null) {
          $(spinner).hasClass('hidden') ? spinner.classList.remove('hidden') : spinner.classList.add('hidden');

          if (!$(spinner).hasClass('hidden')) {
            spinner.parentElement.previousElementSibling.style.display = "none";
            spinner.parentElement.style.display = "block";
          } else {
            spinner.parentElement.previousElementSibling.style.display = "block";
            spinner.parentElement.style.display = "none";
          }
        }
      },
      // Sets the loader in the submit button of the given form.
      changeLoadingButtonState: function changeLoadingButtonState(form) {
        if (form.querySelector('.spinner-border') !== null) {
          var spinner = form.querySelector('.spinner-border');
          $(spinner).hasClass('hidden') ? spinner.classList.remove('hidden') : spinner.classList.add('hidden');

          if (!$(spinner).hasClass('hidden')) {
            spinner.parentElement.previousElementSibling.style.display = "none";
            spinner.parentElement.style.display = "block";
          } else {
            spinner.parentElement.previousElementSibling.style.display = "block";
            spinner.parentElement.style.display = "none";
          }

          return true;
        }

        return false;
      }
    };
  }

  return {
    getInstance: function getInstance() {
      if (!instance) {
        instance = init();
      }

      return instance;
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (UI.getInstance());

/***/ }),

/***/ "./resources/js/main/api.js":
/*!**********************************!*\
  !*** ./resources/js/main/api.js ***!
  \**********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

var api = {
  confirm: function () {
    var _confirm = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(url, data) {
      var response;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              api.setTokenToAxiosHeader(data);
              _context.prev = 1;
              _context.next = 4;
              return axios({
                method: 'post',
                url: url,
                data: data
              });

            case 4:
              response = _context.sent;
              _context.next = 7;
              return response.data;

            case 7:
              return _context.abrupt("return", _context.sent);

            case 10:
              _context.prev = 10;
              _context.t0 = _context["catch"](1);
              console.error('Unable to connect to the server');

            case 13:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, null, [[1, 10]]);
    }));

    function confirm(_x, _x2) {
      return _confirm.apply(this, arguments);
    }

    return confirm;
  }(),
  getResource: function () {
    var _getResource = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(resource, parameters) {
      var requestURL, response;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              requestURL = api.getHostName() + '/api/' + resource;
              Object.keys(parameters).forEach(function (key) {
                requestURL += '/' + parameters[key];
              });
              _context2.prev = 2;
              _context2.next = 5;
              return axios({
                method: 'GET',
                url: requestURL
              });

            case 5:
              response = _context2.sent;
              return _context2.abrupt("return", response.data);

            case 9:
              _context2.prev = 9;
              _context2.t0 = _context2["catch"](2);
              console.log(_context2.t0);

            case 12:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2, null, [[2, 9]]);
    }));

    function getResource(_x3, _x4) {
      return _getResource.apply(this, arguments);
    }

    return getResource;
  }(),
  getHostName: function getHostName() {
    return window.location.protocol + '//' + window.location.hostname;
  },
  sendPaymentMethod: function () {
    var _sendPaymentMethod = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(data) {
      var response;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              api.setTokenToAxiosHeader();
              _context3.prev = 1;
              _context3.next = 4;
              return axios({
                method: 'post',
                url: api.getHostName() + '/payment-method',
                data: data
              });

            case 4:
              response = _context3.sent;
              console.log(response);
              return _context3.abrupt("return", response);

            case 9:
              _context3.prev = 9;
              _context3.t0 = _context3["catch"](1);
              console.log(_context3.t0.response);

            case 12:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3, null, [[1, 9]]);
    }));

    function sendPaymentMethod(_x5) {
      return _sendPaymentMethod.apply(this, arguments);
    }

    return sendPaymentMethod;
  }(),
  getDialog: function () {
    var _getDialog = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4(url, token) {
      var response;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
        while (1) {
          switch (_context4.prev = _context4.next) {
            case 0:
              _context4.prev = 0;
              _context4.next = 3;
              return axios({
                method: 'post',
                url: url,
                data: token
              });

            case 3:
              response = _context4.sent;
              _context4.next = 6;
              return response.data;

            case 6:
              return _context4.abrupt("return", _context4.sent);

            case 9:
              _context4.prev = 9;
              _context4.t0 = _context4["catch"](0);
              console.log(_context4.t0.response);

            case 12:
            case "end":
              return _context4.stop();
          }
        }
      }, _callee4, null, [[0, 9]]);
    }));

    function getDialog(_x6, _x7) {
      return _getDialog.apply(this, arguments);
    }

    return getDialog;
  }(),
  validate: function () {
    var _validate = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5(field) {
      var response;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
        while (1) {
          switch (_context5.prev = _context5.next) {
            case 0:
              api.setTokenToAxiosHeader();
              _context5.next = 3;
              return axios({
                method: 'post',
                headers: {
                  'Content-type': 'application/json'
                },
                url: '/validate/' + field.name,
                data: field
              }).then(function (response) {
                return null;
              })["catch"](function (error) {
                return error.response.data.errors;
              });

            case 3:
              response = _context5.sent;
              _context5.next = 6;
              return response;

            case 6:
              return _context5.abrupt("return", _context5.sent);

            case 7:
            case "end":
              return _context5.stop();
          }
        }
      }, _callee5);
    }));

    function validate(_x8) {
      return _validate.apply(this, arguments);
    }

    return validate;
  }(),
  validateFields: function () {
    var _validateFields = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6(type, object) {
      var response;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
        while (1) {
          switch (_context6.prev = _context6.next) {
            case 0:
              api.setTokenToAxiosHeader();
              _context6.next = 3;
              return axios({
                method: 'post',
                headers: {
                  'Content-type': 'application/json'
                },
                url: '/validate/' + type,
                data: object
              }).then(function (response) {
                return response.data;
              })["catch"](function (error) {
                console.log(error.response);
                return error.response.data;
              });

            case 3:
              response = _context6.sent;
              _context6.next = 6;
              return response;

            case 6:
              return _context6.abrupt("return", _context6.sent);

            case 7:
            case "end":
              return _context6.stop();
          }
        }
      }, _callee6);
    }));

    function validateFields(_x9, _x10) {
      return _validateFields.apply(this, arguments);
    }

    return validateFields;
  }(),
  setTokenToAxiosHeader: function setTokenToAxiosHeader() {
    console.log(api.getToken());
    axios.defaults.headers.common['X-CSRF-TOKEN'] = api.getToken();
  },
  getPagination: function getPagination(url, container) {
    if (url !== undefined) {
      var request = {
        url: url.split('page=')[0],
        page: url.split('page=')[1]
      };
      $.get({
        data: {
          page: request.page
        },
        dataType: 'json',
        cache: false,
        url: request.url,
        error: function error(xhr, status, _error) {
          console.log(_error);
        },
        success: function success(data, status) {
          $(container.previousElementSibling).remove();
          $(container).before(data);
        }
      });
    }

    return false;
  },
  getToken: function getToken() {
    return document.head.querySelector('meta[name="csrf-token"').getAttribute('content');
  },
  getCourseInfo: function getCourseInfo(category, callback) {
    var data = {
      'category': category
    };
    $.post({
      url: 'category-info',
      cache: false,
      data: data,
      dataType: 'html',
      headers: {
        'X-CSRF-TOKEN': api.getToken()
      },
      error: function error(xhr, status, _error2) {
        console.log(_error2);
      },
      success: function success(data, status, xhr) {
        callback(data);
      }
    });
  }
};
/* harmony default export */ __webpack_exports__["default"] = (api);

/***/ }),

/***/ "./resources/js/main/breakpoints.js":
/*!******************************************!*\
  !*** ./resources/js/main/breakpoints.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var MediaQueries = function () {
  var instance;

  function init() {
    // Private properties
    var smallDevices = '(max-width: 680px)';
    var customerJourney = '(min-width: 460px)';
    var mediumDevices = '(min-width: 681px)';
    var largeDevices = '(min-width: 993px)';
    var navbarBreakpoint = '(min-width: 992px)'; // Private methods

    return {
      // Public properties
      // Public methods
      get: function get(key) {
        return eval(key);
      },
      isNavbarBreakpoint: function isNavbarBreakpoint() {
        return window.matchMedia(this.get('navbarBreakpoint')).matches;
      },
      isSmallDevice: function isSmallDevice() {
        return window.matchMedia(this.get('smallDevices')).matches;
      },
      isMediumDevice: function isMediumDevice() {
        return window.matchMedia(this.get('mediumDevices')).matches;
      },
      isCustomerJourney: function isCustomerJourney() {
        return window.matchMedia(this.get('customerJourney')).matches;
      },
      isLargeDevice: function isLargeDevice() {
        return window.matchMedia(this.get('largeDevices')).matches;
      }
    };
  }

  return {
    getInstance: function getInstance() {
      if (!instance) {
        instance = init();
      }

      return instance;
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (MediaQueries.getInstance()); // let breakpoints = {
//     heights: {
//         smallDevices: 156,
//         mediumDevices: 146,
//         largeDevices: 100
//     },
//     widths: {
//         smallDevices: [0, 680],
//         customerJourney: [0, 460],
//         mediumDevices: [681, 992],
//         largeDevices: [993]
//     },
//     isLargeDevice: () => {
//         return window.innerWidth >= breakpoints.widths.largeDevices[0];
//     },
//     isMediumDevice: () => {
//         return window.innerWidth >= breakpoints.widths.mediumDevices[0] && window.innerWidth < breakpoints.widths.mediumDevices[1];
//     },
//     isSmallDevice: () => {
//         return window.innerWidth >= 0 && window.innerWidth < breakpoints.widths.smallDevices[1];
//     },
//     isCustomerJourney: () => {
//         return window.innerWidth >= 0 && window.innerWidth < breakpoints.widths.customerJourney[1];
//     }
//
// };
//
// export default breakpoints;

/***/ }),

/***/ "./resources/js/main/dom.js":
/*!**********************************!*\
  !*** ./resources/js/main/dom.js ***!
  \**********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var DOM = function () {
  var instance;

  function init() {
    // Private properties
    // Private methods
    return {
      // Public properties
      // Public methods
      setProperty: function setProperty(element, property, value) {
        element.style[property] = value;
      },
      getProperty: function getProperty(element, property) {
        return element.style.getPropertyValue(property);
      },
      resetProperty: function resetProperty(element, property) {
        element.style[property] = '';
      },
      toggleClass: function toggleClass(element, firstClassName, secondClassName) {
        $(element).toggleClass(firstClassName);
        $(element).toggleClass(secondClassName);
      },
      removeSingleClass: function removeSingleClass(element, className) {
        $(element).removeClass(className);
      },
      expandToViewport: function expandToViewport(element) {
        $(element).width(document.body.clientWidth);
      },
      toggleSingleClass: function toggleSingleClass(element, className) {
        $(element).toggleClass(className);
      },
      getHighestElement: function getHighestElement(elements) {
        var elementsHeight = [];

        for (var i = 0; i < elements.length; i++) {
          elementsHeight.push(elements[i].clientHeight);
        }

        return elements[elementsHeight.indexOf(Math.max.apply(null, elementsHeight))];
      },
      isDisabled: function isDisabled(element) {
        return element.getAttribute('disabled') || element.getAttribute('aria-disabled');
      },
      hide: function hide(element) {
        element.classList.add('hidden');
        element.setAttribute('aria-hidden', true);
      },
      show: function show(element) {
        element.classList.remove('hidden');
        element.setAttribute('aria-hidden', false);
      }
    };
  }

  ;
  return {
    getInstance: function getInstance() {
      if (!instance) {
        instance = init();
      }

      return instance;
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (DOM.getInstance());

/***/ }),

/***/ "./resources/js/main/domObserver.js":
/*!******************************************!*\
  !*** ./resources/js/main/domObserver.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var domObserver = function () {
  var MutationObserver = window.MutationObserver || window.WebkitMutation.Observer;
  return function (object, callback) {
    // Checks if the Object is an nodeType or a DOM element.
    if (!object || !object.nodeType === 1) return;

    if (MutationObserver) {
      // Define a new observer
      var observer = new MutationObserver(function (mutations, observer) {
        callback(mutations);
      }); // Adds the DOM element or the nodeType to the list of observed nodes.

      observer.observe(object, {
        childList: true,
        subtree: true
      });
    } else if (window.addEventListener) {
      object.addEventListener('DOMNodeInserted', callback, false);
      object.addEventListener('DOMNodeRemoved', callback, false);
    }
  };
}();

/* harmony default export */ __webpack_exports__["default"] = (domObserver);

/***/ }),

/***/ "./resources/js/main/messages.js":
/*!***************************************!*\
  !*** ./resources/js/main/messages.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var messages = {
  form: {
    labels: [],
    inputs: [],
    errors: [],
    advices: {
      removeOffer: function removeOffer(value) {
        return "Are you sure you want to remove permanently ".concat(value, " offer?");
      }
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (messages);

/***/ }),

/***/ "./resources/js/pages/admin/dashboard.js":
/*!***********************************************!*\
  !*** ./resources/js/pages/admin/dashboard.js ***!
  \***********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_AccordionList__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/AccordionList */ "./resources/js/components/AccordionList.js");
/* harmony import */ var _components_MediaCards__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/MediaCards */ "./resources/js/components/MediaCards.js");
/* harmony import */ var _components_forms_DeleteOfferForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/forms/DeleteOfferForm */ "./resources/js/components/forms/DeleteOfferForm.js");
/* harmony import */ var _components_forms_DeleteUserForm__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../components/forms/DeleteUserForm */ "./resources/js/components/forms/DeleteUserForm.js");
/* harmony import */ var _components_forms_DeleteFeeForm__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../components/forms/DeleteFeeForm */ "./resources/js/components/forms/DeleteFeeForm.js");
/* harmony import */ var _components_FlexTable__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../components/FlexTable */ "./resources/js/components/FlexTable.js");
/* harmony import */ var _components_filters_UserStatusFilter__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../components/filters/UserStatusFilter */ "./resources/js/components/filters/UserStatusFilter.js");








(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('main#dashboard') !== null) {
      if (document.querySelector('#offers-content-tab') !== null) {
        var offersCards = _components_MediaCards__WEBPACK_IMPORTED_MODULE_1__["mediaCardFactory"].createCard({
          el: document.getElementById('offers'),
          type: 'media',
          form: _components_forms_DeleteOfferForm__WEBPACK_IMPORTED_MODULE_2__["deleteOfferFormFactory"].createForm({
            form: document.getElementById('delete-offer'),
            type: 'delete-offer'
          }).init()
        }).init();
        $(offersCards.form.modal.getAllTriggerElements().each(function (key, element) {
          element.addEventListener('click', function (ev) {
            offersCards.form.modal.setModalTitle(offersCards.getCardTitle(offersCards.getParentItem(element)).innerText);
            offersCards.form.setItemAction(ev.target);
          });
        }));
      }

      if (document.querySelector('#users-content-tab') !== null) {
        var usersList = _components_AccordionList__WEBPACK_IMPORTED_MODULE_0__["accordionListFactory"].createList({
          el: document.getElementById('users'),
          type: 'accordion',
          form: _components_forms_DeleteUserForm__WEBPACK_IMPORTED_MODULE_3__["deleteUserFormFactory"].createForm({
            form: document.getElementById('delete-user'),
            type: 'delete-user'
          }).init()
        }).init();
        $(usersList.form.modal.getAllTriggerElements()).each(function (key, element) {
          element.addEventListener('click', function (ev) {
            usersList.form.modal.setModalTitle(usersList.getCardTitle(usersList.getParentCard(element)).innerText);
            usersList.form.setItemAction(ev.target);
          });
        });

        if (document.getElementById('statusFilter') !== null) {
          var UsersStatusFilter = new _components_filters_UserStatusFilter__WEBPACK_IMPORTED_MODULE_6__["userStatusFilterFactory"].createFilter({
            type: 'user-status',
            filter: document.getElementById('statusFilter'),
            callback: function callback(data) {
              $(document.querySelector('#users-content-tab')).find('.accordion-list').remove();
              $(document.querySelector('#users-content-tab')).find('.items-pagination').remove();
              $(document.querySelector('#users-content-tab')).find('.content-tab').append(data);
            }
          });
        }
      }

      if (document.querySelector('#fees-content-tab') !== null) {
        var feesTable = _components_FlexTable__WEBPACK_IMPORTED_MODULE_5__["flexTableFactory"].createTable({
          el: document.getElementById('fees'),
          type: 'flex',
          form: _components_forms_DeleteFeeForm__WEBPACK_IMPORTED_MODULE_4__["deleteFeeFormFactory"].createForm({
            form: document.getElementById('delete-fee'),
            type: 'delete-fee'
          }).init()
        }).init();
        $(feesTable.form.modal.getAllTriggerElements()).each(function (key, element) {
          element.addEventListener('click', function (ev) {
            feesTable.form.modal.setModalTitle(feesTable.rowTitle(ev.target).innerText);
            feesTable.form.setItemAction(ev.target);
          });
        });
      }
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/admin/fee.js":
/*!*****************************************!*\
  !*** ./resources/js/pages/admin/fee.js ***!
  \*****************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_EditFeeForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/forms/EditFeeForm */ "./resources/js/components/forms/EditFeeForm.js");


(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('fee') !== null) {
      var editUserForm = _components_forms_EditFeeForm__WEBPACK_IMPORTED_MODULE_0__["editFeeFormFactory"].createForm({
        form: document.getElementById('edit-fee'),
        type: 'edit-fee'
      }).init();
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/admin/new-fee.js":
/*!*********************************************!*\
  !*** ./resources/js/pages/admin/new-fee.js ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_CreateFeeForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/forms/CreateFeeForm */ "./resources/js/components/forms/CreateFeeForm.js");


(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('new-fee') !== null) {
      var createOfferForm = _components_forms_CreateFeeForm__WEBPACK_IMPORTED_MODULE_0__["createFeeFormFactory"].createForm({
        form: document.getElementById('create-fee'),
        type: 'create-fee'
      }).init();
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/admin/new-offer.js":
/*!***********************************************!*\
  !*** ./resources/js/pages/admin/new-offer.js ***!
  \***********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_CreateOfferForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/forms/CreateOfferForm */ "./resources/js/components/forms/CreateOfferForm.js");


(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('new-offer') !== null) {
      var createOfferForm = _components_forms_CreateOfferForm__WEBPACK_IMPORTED_MODULE_0__["createOfferFormFactory"].createForm({
        form: document.getElementById('create-offer'),
        type: 'create-offer'
      }).init();
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/admin/offer.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/admin/offer.js ***!
  \*******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_EditOfferForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/forms/EditOfferForm */ "./resources/js/components/forms/EditOfferForm.js");


(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('main#offer')) {
      var editOfferForm = _components_forms_EditOfferForm__WEBPACK_IMPORTED_MODULE_0__["editOfferFormFactory"].createForm({
        form: document.getElementById('edit-offer'),
        type: 'edit-offer'
      }).init();
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/admin/upgrade.js":
/*!*********************************************!*\
  !*** ./resources/js/pages/admin/upgrade.js ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_UpgradeUserForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/forms/UpgradeUserForm */ "./resources/js/components/forms/UpgradeUserForm.js");

window.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('main#upgrade') !== null) {
    var userUpgradeForm = _components_forms_UpgradeUserForm__WEBPACK_IMPORTED_MODULE_0__["upgradeUserFormFactory"].createForm({
      form: document.getElementById('upgrade-user'),
      type: 'upgrade-user'
    }).init();
    console.log(userUpgradeForm);
  }
});

/***/ }),

/***/ "./resources/js/pages/admin/user.js":
/*!******************************************!*\
  !*** ./resources/js/pages/admin/user.js ***!
  \******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_EditUserForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/forms/EditUserForm */ "./resources/js/components/forms/EditUserForm.js");


(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('user') !== null) {
      var editUserForm = _components_forms_EditUserForm__WEBPACK_IMPORTED_MODULE_0__["editUserFormFactory"].createForm({
        form: document.getElementById('edit-user'),
        type: 'edit-user'
      }).init();
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/home.js":
/*!************************************!*\
  !*** ./resources/js/pages/home.js ***!
  \************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_LoginForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/forms/LoginForm */ "./resources/js/components/forms/LoginForm.js");
/* harmony import */ var _components_Infography__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/Infography */ "./resources/js/components/Infography.js");
/* harmony import */ var _facades_api__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../facades/api */ "./resources/js/facades/api.js");




(function () {
  window.addEventListener('DOMContentLoaded', function () {
    var loginForm = _components_forms_LoginForm__WEBPACK_IMPORTED_MODULE_0__["loginFormFactory"].createForm({
      form: document.getElementById('login'),
      type: 'login',
      modal: document.getElementById('loginModal')
    }).init();

    if (document.getElementById('home')) {
      loadHeader();
    }

    if (document.getElementById('customer-journey') !== null) {
      var customerJourneyInfography = _components_Infography__WEBPACK_IMPORTED_MODULE_1__["infographyFactory"].createInfography({
        el: document.getElementById('customer-journey').querySelector('.infography')
      }).init();
    }

    function loadHeader() {
      var background = _facades_api__WEBPACK_IMPORTED_MODULE_2__["default"].getRoute('hostname') + '/storage/images/headers/home.jpg';
      var header = document.querySelector('header');
      var img = new Image();
      img.src = background;

      img.onload = function () {
        header.style.backgroundImage = "url(".concat(background, ")");
      };
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/job-description.js":
/*!***********************************************!*\
  !*** ./resources/js/pages/job-description.js ***!
  \***********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_BottomNavigation__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/BottomNavigation */ "./resources/js/components/BottomNavigation.js");


(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('job-description') !== null) {
      var offerNavigation = _components_BottomNavigation__WEBPACK_IMPORTED_MODULE_0__["bottomNavigationFactory"].createNavigation({
        el: document.querySelector('.bottom-navigation'),
        type: 'bottom'
      }).init();
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/learn-chinese.js":
/*!*********************************************!*\
  !*** ./resources/js/pages/learn-chinese.js ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_ArrowSlider__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/ArrowSlider */ "./resources/js/components/ArrowSlider.js");
/* harmony import */ var _main_api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/api */ "./resources/js/main/api.js");



(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('main#learn-chinese') !== null) {
      var learnChineseSlider = _components_ArrowSlider__WEBPACK_IMPORTED_MODULE_0__["arrowSliderFactory"].createSlider({
        type: 'arrow',
        sections: ['in-person', 'online'],
        callbacks: {
          controllers: function controllers(slider) {
            var category = slider.querySelector('input[name=category]').value;
            _main_api__WEBPACK_IMPORTED_MODULE_1__["default"].getCourseInfo(category, replaceCategoryInfoBox);
          }
        }
      });

      var replaceCategoryInfoBox = function replaceCategoryInfoBox(newSection) {
        var section = $('section#course-info');
        $(section).children('.c-price-box')[0].remove();
        $(section).append(newSection);
      };
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/user/dashboard.js":
/*!**********************************************!*\
  !*** ./resources/js/pages/user/dashboard.js ***!
  \**********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_EditUserForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/forms/EditUserForm */ "./resources/js/components/forms/EditUserForm.js");


(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('main#dashboard') !== null) {
      if (document.querySelector('#profile-content-tab')) {
        var editUserForm = _components_forms_EditUserForm__WEBPACK_IMPORTED_MODULE_0__["editUserFormFactory"].createForm({
          form: document.getElementById('edit-user'),
          type: 'edit-user'
        }).init();
      }
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/user/payment.js":
/*!********************************************!*\
  !*** ./resources/js/pages/user/payment.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_PaymentForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/forms/PaymentForm */ "./resources/js/components/forms/PaymentForm.js");


(function () {
  window.addEventListener('DOMContentLoaded', function () {
    var paymentForm = _components_forms_PaymentForm__WEBPACK_IMPORTED_MODULE_0__["paymentFormFactory"].createForm({
      form: document.getElementById('payment'),
      type: 'payment'
    });
    paymentForm.init();
  });
})();

/***/ }),

/***/ "./resources/js/pages/welcome.js":
/*!***************************************!*\
  !*** ./resources/js/pages/welcome.js ***!
  \***************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_forms_ProceedPaymentForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/forms/ProceedPaymentForm */ "./resources/js/components/forms/ProceedPaymentForm.js");
/* harmony import */ var _components_forms_PaymentForm__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/forms/PaymentForm */ "./resources/js/components/forms/PaymentForm.js");



(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('proceed-payment') !== null) {
      var proceedPaymentForm = _components_forms_ProceedPaymentForm__WEBPACK_IMPORTED_MODULE_0__["proceedPaymentFormFactory"].createForm({
        form: document.getElementById('proceed-payment'),
        type: 'proceed-payment'
      });
      proceedPaymentForm.init();
    }
  });
})();

/***/ }),

/***/ "./resources/js/pages/why-intuuchina.js":
/*!**********************************************!*\
  !*** ./resources/js/pages/why-intuuchina.js ***!
  \**********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_SquareGrid__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/SquareGrid */ "./resources/js/components/SquareGrid.js");
/* harmony import */ var _components_Counter__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/Counter */ "./resources/js/components/Counter.js");



(function () {
  window.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('why-intuuchina') !== null) {
      var squareGrid = _components_SquareGrid__WEBPACK_IMPORTED_MODULE_0__["squareGridFactory"].createGrid({
        el: document.getElementById('why-intuuchina').querySelector('.square-grid')
      }).init();
      var statsCounter = _components_Counter__WEBPACK_IMPORTED_MODULE_1__["counterFactory"].createCounter({
        el: document.querySelector('.stats__container')
      }).init();
    }
  });
})();

/***/ }),

/***/ "./resources/js/partials/_nav.js":
/*!***************************************!*\
  !*** ./resources/js/partials/_nav.js ***!
  \***************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");
/* harmony import */ var _main_dom_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/dom.js */ "./resources/js/main/dom.js");



if (document.getElementsByTagName('nav') !== null) {
  var navbar = function () {
    var _navbar = document.querySelector('.navbar') ? document.querySelector('.navbar') : null;

    var _dropdowns = _navbar.querySelectorAll('li.dropdown');

    var _dropdownItems = _navbar.querySelectorAll('a.dropdown-item');

    var _loginModal = document.querySelector('#loginModal');

    var _loginForm = _loginModal.querySelector('.modal__form');

    var _accordionSubmenus = _navbar.querySelectorAll('.accordion_submenu');

    var _listeners = {
      dropdown: function dropdown(_dropdown) {
        if (_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isNavbarBreakpoint()) {
          _dropdown.removeEventListener('click', setDropdowns);

          _dropdown.addEventListener('mouseenter', setDropdowns);

          _dropdown.addEventListener('mouseleave', setDropdowns);
        } else {
          _dropdown.removeEventListener('mouseenter', setDropdowns);

          _dropdown.removeEventListener('mouseleave', setDropdowns);

          _dropdown.addEventListener('click', setDropdowns);
        }
      },
      dropdownItem: function dropdownItem(item) {
        item.addEventListener('click', setDropdownItems);
      },
      shadows: function shadows(ev) {
        if (ev.type === 'click' && ($(ev.target).hasClass('navbar-toggler') || $(ev.target.parentElement).hasClass('navbar-toggler'))) {
          if (!isCollapsed()) {
            return shadow();
          }

          return unshadow();
        }

        if (ev.type === 'load' || ev.type === 'scroll' || ev.type === 'resize') {
          if (window.scrollY > 0) {
            return shadow();
          }

          if (!_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isNavbarBreakpoint()) {
            if (isCollapsed()) {
              return shadow();
            }
          }

          return unshadow();
        }
      }
    };

    function init() {
      window.addEventListener('load', function (ev) {
        if (hasErrorsMessages(_loginForm)) {
          $(_loginModal).modal();
        }

        ;

        _listeners.shadows(ev);

        for (var i = 0; i < _dropdowns.length; i++) {
          _listeners.dropdown(_dropdowns[i]);
        }

        for (var y = 0; y < _dropdownItems.length; y++) {
          _listeners.dropdownItem(_dropdownItems[y]);
        }
      });
      window.addEventListener('resize', function (ev) {
        for (var i = 0; i < _dropdowns.length; i++) {
          _listeners.dropdown(_dropdowns[i]);
        }

        _listeners.shadows(ev);
      });
      window.addEventListener('scroll', function (ev) {
        _listeners.shadows(ev);
      });

      _navbar.querySelector('.navbar-toggler').addEventListener('click', function (ev) {
        _listeners.shadows(ev);
      });
    }

    function toggleDropdown(element) {
      if ($(element).hasClass('show')) {
        $(element).dropdown('hide');
      } else {
        $(element).dropdown('show');
      }
    }

    function shadow() {
      if (!$(_navbar).hasClass('navbar--shadowed')) {
        return _navbar.classList.add('navbar--shadowed');
      }
    }

    function unshadow() {
      if ($(_navbar).hasClass('navbar--shadowed')) {
        return _navbar.classList.remove('navbar--shadowed');
      }
    }

    function isCollapsed() {
      if (_navbar.querySelector('.navbar-toggler').style.display !== 'none') {
        return $(_navbar.querySelector('#navbarToggler')).hasClass('show');
      }

      return false;
    }

    function hasErrorsMessages(element) {
      if ($(element).find('.is-invalid').length > 0) {
        return true;
      }

      return false;
    }

    function setDropdownItems(e) {
      e.preventDefault();
      var URL = e.target.getAttribute('href');
      var anchor = e.target;

      while (URL === null) {
        anchor = anchor.parentElement;
        URL = anchor.getAttribute('href');
      }

      if (anchor.nextElementSibling === null) {
        location.href = URL;
      } else {
        if (anchor.nextElementSibling.tagName !== 'FORM') {
          location.href = URL;
        }
      }
    }

    function setDropdowns(e) {
      var submenu = getSubmenu(e.target);

      switch (e.type) {
        case 'click':
          e.preventDefault();

          if ($(e.target).hasClass('toggleOption')) {
            location.href = e.target.parentElement.getAttribute('href');
          } else {
            toggleDropdown(submenu);
          }

          break;

        case 'mouseenter':
          $(submenu).dropdown('show');
          break;

        case 'mouseleave':
          $(submenu).dropdown('hide');
          break;
      }
    }

    function getSubmenu(menuItem) {
      var submenu = menuItem.querySelector('.dropdown-menu');

      if (submenu === null) {
        submenu = $(menuItem).parents('.dropdown-menu')[0];

        if (submenu === undefined) {
          $(menuItem).parents().map(function () {
            if ($(this).siblings('.dropdown-menu')[0]) {
              submenu = $(this).siblings('.dropdown-menu')[0];
              return submenu;
            }
          });
        }
      }

      return submenu;
    }

    init();
  }();
}

/***/ }),

/***/ 1:
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/pages/home.js ./resources/js/pages/job-description.js ./resources/js/pages/learn-chinese.js ./resources/js/pages/welcome.js ./resources/js/pages/why-intuuchina.js ./resources/js/pages/admin/new-offer.js ./resources/js/pages/admin/new-fee.js ./resources/js/pages/admin/dashboard.js ./resources/js/pages/user/dashboard.js ./resources/js/pages/admin/fee.js ./resources/js/pages/admin/offer.js ./resources/js/pages/admin/user.js ./resources/js/pages/admin/upgrade.js ./resources/js/pages/user/payment.js ./resources/js/partials/_nav.js ./resources/js/components/sliders.js ./resources/js/components/register.js ./resources/js/components/_offers.js ./resources/js/components/_offers-list.js ./resources/js/components/_edit-offer.js ./resources/js/components/_welcome-card.js ./resources/js/components/_footer.js ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/home.js */"./resources/js/pages/home.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/job-description.js */"./resources/js/pages/job-description.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/learn-chinese.js */"./resources/js/pages/learn-chinese.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/welcome.js */"./resources/js/pages/welcome.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/why-intuuchina.js */"./resources/js/pages/why-intuuchina.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/admin/new-offer.js */"./resources/js/pages/admin/new-offer.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/admin/new-fee.js */"./resources/js/pages/admin/new-fee.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/admin/dashboard.js */"./resources/js/pages/admin/dashboard.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/user/dashboard.js */"./resources/js/pages/user/dashboard.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/admin/fee.js */"./resources/js/pages/admin/fee.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/admin/offer.js */"./resources/js/pages/admin/offer.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/admin/user.js */"./resources/js/pages/admin/user.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/admin/upgrade.js */"./resources/js/pages/admin/upgrade.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/pages/user/payment.js */"./resources/js/pages/user/payment.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/partials/_nav.js */"./resources/js/partials/_nav.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/components/sliders.js */"./resources/js/components/sliders.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/components/register.js */"./resources/js/components/register.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/components/_offers.js */"./resources/js/components/_offers.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/components/_offers-list.js */"./resources/js/components/_offers-list.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/components/_edit-offer.js */"./resources/js/components/_edit-offer.js");
__webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/components/_welcome-card.js */"./resources/js/components/_welcome-card.js");
module.exports = __webpack_require__(/*! /media/meinsusseseichhornchen/data/projects/web/apache/slopezrubio/intuuchina/resources/js/components/_footer.js */"./resources/js/components/_footer.js");


/***/ })

/******/ });