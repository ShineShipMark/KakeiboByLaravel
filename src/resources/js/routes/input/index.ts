import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\InputController::index
* @see app/Http/Controllers/InputController.php:0
* @route '/input'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/input',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\InputController::index
* @see app/Http/Controllers/InputController.php:0
* @route '/input'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\InputController::index
* @see app/Http/Controllers/InputController.php:0
* @route '/input'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\InputController::index
* @see app/Http/Controllers/InputController.php:0
* @route '/input'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\InputController::index
* @see app/Http/Controllers/InputController.php:0
* @route '/input'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\InputController::index
* @see app/Http/Controllers/InputController.php:0
* @route '/input'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\InputController::index
* @see app/Http/Controllers/InputController.php:0
* @route '/input'
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

/**
* @see \App\Http\Controllers\InputController::store
* @see app/Http/Controllers/InputController.php:20
* @route '/input'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/input',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\InputController::store
* @see app/Http/Controllers/InputController.php:20
* @route '/input'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\InputController::store
* @see app/Http/Controllers/InputController.php:20
* @route '/input'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\InputController::store
* @see app/Http/Controllers/InputController.php:20
* @route '/input'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\InputController::store
* @see app/Http/Controllers/InputController.php:20
* @route '/input'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

const input = {
    index: Object.assign(index, index),
    store: Object.assign(store, store),
}

export default input