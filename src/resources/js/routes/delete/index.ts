import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/delete/expense'
*/
export const expense = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: expense.url(options),
    method: 'post',
})

expense.definition = {
    methods: ["post"],
    url: '/delete/expense',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/delete/expense'
*/
expense.url = (options?: RouteQueryOptions) => {
    return expense.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/delete/expense'
*/
expense.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: expense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/delete/expense'
*/
const expenseForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: expense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/delete/expense'
*/
expenseForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: expense.url(options),
    method: 'post',
})

expense.form = expenseForm

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:94
* @route '/delete/income'
*/
export const income = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: income.url(options),
    method: 'post',
})

income.definition = {
    methods: ["post"],
    url: '/delete/income',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:94
* @route '/delete/income'
*/
income.url = (options?: RouteQueryOptions) => {
    return income.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:94
* @route '/delete/income'
*/
income.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: income.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:94
* @route '/delete/income'
*/
const incomeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: income.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:94
* @route '/delete/income'
*/
incomeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: income.url(options),
    method: 'post',
})

income.form = incomeForm

const deleteMethod = {
    expense: Object.assign(expense, expense),
    income: Object.assign(income, income),
}

export default deleteMethod