import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\MasterController::masters
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
export const masters = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: masters.url(options),
    method: 'get',
})

masters.definition = {
    methods: ["get","head"],
    url: '/api/masters',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\MasterController::masters
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
masters.url = (options?: RouteQueryOptions) => {
    return masters.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\MasterController::masters
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
masters.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: masters.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\MasterController::masters
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
masters.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: masters.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\MasterController::masters
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
const mastersForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: masters.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\MasterController::masters
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
mastersForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: masters.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\MasterController::masters
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
mastersForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: masters.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

masters.form = mastersForm

const api = {
    masters: Object.assign(masters, masters),
}

export default api