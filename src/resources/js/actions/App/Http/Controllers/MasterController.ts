import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\MasterController::index
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/api/masters',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\MasterController::index
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\MasterController::index
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\MasterController::index
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\MasterController::index
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\MasterController::index
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\MasterController::index
* @see app/Http/Controllers/MasterController.php:16
* @route '/api/masters'
*/
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index.form = indexForm

const MasterController = { index }

export default MasterController