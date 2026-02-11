import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\KakeiboController::expense_purpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
export const expense_purpose = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: expense_purpose.url(options),
    method: 'get',
})

expense_purpose.definition = {
    methods: ["get","head"],
    url: '/get_expense_purpose',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::expense_purpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
expense_purpose.url = (options?: RouteQueryOptions) => {
    return expense_purpose.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::expense_purpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
expense_purpose.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: expense_purpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense_purpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
expense_purpose.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: expense_purpose.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense_purpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
const expense_purposeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense_purpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense_purpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
expense_purposeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense_purpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense_purpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
expense_purposeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense_purpose.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

expense_purpose.form = expense_purposeForm

/**
* @see \App\Http\Controllers\KakeiboController::income_purpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
export const income_purpose = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: income_purpose.url(options),
    method: 'get',
})

income_purpose.definition = {
    methods: ["get","head"],
    url: '/get_income_purpose',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::income_purpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
income_purpose.url = (options?: RouteQueryOptions) => {
    return income_purpose.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::income_purpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
income_purpose.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: income_purpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income_purpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
income_purpose.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: income_purpose.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::income_purpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
const income_purposeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income_purpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income_purpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
income_purposeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income_purpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income_purpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
income_purposeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income_purpose.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

income_purpose.form = income_purposeForm

/**
* @see \App\Http\Controllers\KakeiboController::expense_category
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
export const expense_category = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: expense_category.url(options),
    method: 'get',
})

expense_category.definition = {
    methods: ["get","head"],
    url: '/get_expense_category',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::expense_category
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
expense_category.url = (options?: RouteQueryOptions) => {
    return expense_category.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::expense_category
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
expense_category.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: expense_category.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense_category
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
expense_category.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: expense_category.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense_category
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
const expense_categoryForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense_category.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense_category
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
expense_categoryForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense_category.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense_category
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
expense_categoryForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense_category.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

expense_category.form = expense_categoryForm

/**
* @see \App\Http\Controllers\KakeiboController::income_category
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
export const income_category = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: income_category.url(options),
    method: 'get',
})

income_category.definition = {
    methods: ["get","head"],
    url: '/get_income_category',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::income_category
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
income_category.url = (options?: RouteQueryOptions) => {
    return income_category.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::income_category
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
income_category.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: income_category.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income_category
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
income_category.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: income_category.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::income_category
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
const income_categoryForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income_category.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income_category
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
income_categoryForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income_category.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income_category
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
income_categoryForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income_category.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

income_category.form = income_categoryForm

const get = {
    expense_purpose: Object.assign(expense_purpose, expense_purpose),
    income_purpose: Object.assign(income_purpose, income_purpose),
    expense_category: Object.assign(expense_category, expense_category),
    income_category: Object.assign(income_category, income_category),
}

export default get