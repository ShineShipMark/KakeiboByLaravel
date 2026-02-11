import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
export const expense = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: expense.url(options),
    method: 'post',
})

expense.definition = {
    methods: ["post"],
    url: '/edit/expense',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
expense.url = (options?: RouteQueryOptions) => {
    return expense.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
expense.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: expense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
const expenseForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: expense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::expense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
expenseForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: expense.url(options),
    method: 'post',
})

expense.form = expenseForm

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
export const income = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: income.url(options),
    method: 'post',
})

income.definition = {
    methods: ["post"],
    url: '/edit/income',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
income.url = (options?: RouteQueryOptions) => {
    return income.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
income.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: income.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
const incomeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: income.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::income
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
incomeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: income.url(options),
    method: 'post',
})

income.form = incomeForm

const edit = {
    expense: Object.assign(expense, expense),
    income: Object.assign(income, income),
}

export default edit