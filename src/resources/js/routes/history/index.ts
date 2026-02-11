import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
export const expense = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: expense.url(options),
    method: 'get',
})

expense.definition = {
    methods: ["get","head"],
    url: '/history/expense',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
expense.url = (options?: RouteQueryOptions) => {
    return expense.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
expense.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: expense.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
expense.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: expense.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
const expenseForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
expenseForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
expenseForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: expense.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

expense.form = expenseForm

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
export const income = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: income.url(options),
    method: 'get',
})

income.definition = {
    methods: ["get","head"],
    url: '/history/income',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
income.url = (options?: RouteQueryOptions) => {
    return income.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
income.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: income.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
income.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: income.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
const incomeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
incomeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
incomeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: income.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

income.form = incomeForm

const history = {
    expense: Object.assign(expense, expense),
    income: Object.assign(income, income),
}

export default history