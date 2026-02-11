import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\KakeiboController::renderPage
* @see app/Http/Controllers/KakeiboController.php:24
* @route '/edit'
*/
export const renderPage = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: renderPage.url(options),
    method: 'get',
})

renderPage.definition = {
    methods: ["get","head"],
    url: '/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::renderPage
* @see app/Http/Controllers/KakeiboController.php:24
* @route '/edit'
*/
renderPage.url = (options?: RouteQueryOptions) => {
    return renderPage.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::renderPage
* @see app/Http/Controllers/KakeiboController.php:24
* @route '/edit'
*/
renderPage.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: renderPage.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::renderPage
* @see app/Http/Controllers/KakeiboController.php:24
* @route '/edit'
*/
renderPage.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: renderPage.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::renderPage
* @see app/Http/Controllers/KakeiboController.php:24
* @route '/edit'
*/
const renderPageForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: renderPage.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::renderPage
* @see app/Http/Controllers/KakeiboController.php:24
* @route '/edit'
*/
renderPageForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: renderPage.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::renderPage
* @see app/Http/Controllers/KakeiboController.php:24
* @route '/edit'
*/
renderPageForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: renderPage.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

renderPage.form = renderPageForm

/**
* @see \App\Http\Controllers\KakeiboController::getExpense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
export const getExpense = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getExpense.url(options),
    method: 'get',
})

getExpense.definition = {
    methods: ["get","head"],
    url: '/history/expense',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::getExpense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
getExpense.url = (options?: RouteQueryOptions) => {
    return getExpense.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::getExpense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
getExpense.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getExpense.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
getExpense.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getExpense.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
const getExpenseForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpense.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
getExpenseForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpense.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpense
* @see app/Http/Controllers/KakeiboController.php:30
* @route '/history/expense'
*/
getExpenseForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpense.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

getExpense.form = getExpenseForm

/**
* @see \App\Http\Controllers\KakeiboController::getIncome
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
export const getIncome = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getIncome.url(options),
    method: 'get',
})

getIncome.definition = {
    methods: ["get","head"],
    url: '/history/income',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::getIncome
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
getIncome.url = (options?: RouteQueryOptions) => {
    return getIncome.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::getIncome
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
getIncome.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getIncome.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncome
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
getIncome.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getIncome.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncome
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
const getIncomeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncome.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncome
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
getIncomeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncome.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncome
* @see app/Http/Controllers/KakeiboController.php:35
* @route '/history/income'
*/
getIncomeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncome.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

getIncome.form = getIncomeForm

/**
* @see \App\Http\Controllers\KakeiboController::inputExpense
* @see app/Http/Controllers/KakeiboController.php:40
* @route '/input/expense'
*/
export const inputExpense = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: inputExpense.url(options),
    method: 'post',
})

inputExpense.definition = {
    methods: ["post"],
    url: '/input/expense',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::inputExpense
* @see app/Http/Controllers/KakeiboController.php:40
* @route '/input/expense'
*/
inputExpense.url = (options?: RouteQueryOptions) => {
    return inputExpense.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::inputExpense
* @see app/Http/Controllers/KakeiboController.php:40
* @route '/input/expense'
*/
inputExpense.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: inputExpense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::inputExpense
* @see app/Http/Controllers/KakeiboController.php:40
* @route '/input/expense'
*/
const inputExpenseForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: inputExpense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::inputExpense
* @see app/Http/Controllers/KakeiboController.php:40
* @route '/input/expense'
*/
inputExpenseForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: inputExpense.url(options),
    method: 'post',
})

inputExpense.form = inputExpenseForm

/**
* @see \App\Http\Controllers\KakeiboController::inputIncome
* @see app/Http/Controllers/KakeiboController.php:46
* @route '/input/income'
*/
export const inputIncome = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: inputIncome.url(options),
    method: 'post',
})

inputIncome.definition = {
    methods: ["post"],
    url: '/input/income',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::inputIncome
* @see app/Http/Controllers/KakeiboController.php:46
* @route '/input/income'
*/
inputIncome.url = (options?: RouteQueryOptions) => {
    return inputIncome.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::inputIncome
* @see app/Http/Controllers/KakeiboController.php:46
* @route '/input/income'
*/
inputIncome.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: inputIncome.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::inputIncome
* @see app/Http/Controllers/KakeiboController.php:46
* @route '/input/income'
*/
const inputIncomeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: inputIncome.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::inputIncome
* @see app/Http/Controllers/KakeiboController.php:46
* @route '/input/income'
*/
inputIncomeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: inputIncome.url(options),
    method: 'post',
})

inputIncome.form = inputIncomeForm

/**
* @see \App\Http\Controllers\KakeiboController::editExpense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
export const editExpense = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: editExpense.url(options),
    method: 'post',
})

editExpense.definition = {
    methods: ["post"],
    url: '/edit/expense',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::editExpense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
editExpense.url = (options?: RouteQueryOptions) => {
    return editExpense.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::editExpense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
editExpense.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: editExpense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::editExpense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
const editExpenseForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: editExpense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::editExpense
* @see app/Http/Controllers/KakeiboController.php:52
* @route '/edit/expense'
*/
editExpenseForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: editExpense.url(options),
    method: 'post',
})

editExpense.form = editExpenseForm

/**
* @see \App\Http\Controllers\KakeiboController::editIncome
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
export const editIncome = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: editIncome.url(options),
    method: 'post',
})

editIncome.definition = {
    methods: ["post"],
    url: '/edit/income',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::editIncome
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
editIncome.url = (options?: RouteQueryOptions) => {
    return editIncome.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::editIncome
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
editIncome.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: editIncome.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::editIncome
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
const editIncomeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: editIncome.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::editIncome
* @see app/Http/Controllers/KakeiboController.php:60
* @route '/edit/income'
*/
editIncomeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: editIncome.url(options),
    method: 'post',
})

editIncome.form = editIncomeForm

/**
* @see \App\Http\Controllers\KakeiboController::deleteExpense
* @see app/Http/Controllers/KakeiboController.php:68
* @route '/delete/expense'
*/
export const deleteExpense = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: deleteExpense.url(options),
    method: 'post',
})

deleteExpense.definition = {
    methods: ["post"],
    url: '/delete/expense',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::deleteExpense
* @see app/Http/Controllers/KakeiboController.php:68
* @route '/delete/expense'
*/
deleteExpense.url = (options?: RouteQueryOptions) => {
    return deleteExpense.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::deleteExpense
* @see app/Http/Controllers/KakeiboController.php:68
* @route '/delete/expense'
*/
deleteExpense.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: deleteExpense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::deleteExpense
* @see app/Http/Controllers/KakeiboController.php:68
* @route '/delete/expense'
*/
const deleteExpenseForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteExpense.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::deleteExpense
* @see app/Http/Controllers/KakeiboController.php:68
* @route '/delete/expense'
*/
deleteExpenseForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteExpense.url(options),
    method: 'post',
})

deleteExpense.form = deleteExpenseForm

/**
* @see \App\Http\Controllers\KakeiboController::deleteIncome
* @see app/Http/Controllers/KakeiboController.php:75
* @route '/delete/income'
*/
export const deleteIncome = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: deleteIncome.url(options),
    method: 'post',
})

deleteIncome.definition = {
    methods: ["post"],
    url: '/delete/income',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\KakeiboController::deleteIncome
* @see app/Http/Controllers/KakeiboController.php:75
* @route '/delete/income'
*/
deleteIncome.url = (options?: RouteQueryOptions) => {
    return deleteIncome.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::deleteIncome
* @see app/Http/Controllers/KakeiboController.php:75
* @route '/delete/income'
*/
deleteIncome.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: deleteIncome.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::deleteIncome
* @see app/Http/Controllers/KakeiboController.php:75
* @route '/delete/income'
*/
const deleteIncomeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteIncome.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\KakeiboController::deleteIncome
* @see app/Http/Controllers/KakeiboController.php:75
* @route '/delete/income'
*/
deleteIncomeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteIncome.url(options),
    method: 'post',
})

deleteIncome.form = deleteIncomeForm

/**
* @see \App\Http\Controllers\KakeiboController::getExpensePurpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
export const getExpensePurpose = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getExpensePurpose.url(options),
    method: 'get',
})

getExpensePurpose.definition = {
    methods: ["get","head"],
    url: '/get_expense_purpose',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::getExpensePurpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
getExpensePurpose.url = (options?: RouteQueryOptions) => {
    return getExpensePurpose.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::getExpensePurpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
getExpensePurpose.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getExpensePurpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpensePurpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
getExpensePurpose.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getExpensePurpose.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpensePurpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
const getExpensePurposeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpensePurpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpensePurpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
getExpensePurposeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpensePurpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpensePurpose
* @see app/Http/Controllers/KakeiboController.php:82
* @route '/get_expense_purpose'
*/
getExpensePurposeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpensePurpose.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

getExpensePurpose.form = getExpensePurposeForm

/**
* @see \App\Http\Controllers\KakeiboController::getIncomePurpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
export const getIncomePurpose = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getIncomePurpose.url(options),
    method: 'get',
})

getIncomePurpose.definition = {
    methods: ["get","head"],
    url: '/get_income_purpose',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::getIncomePurpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
getIncomePurpose.url = (options?: RouteQueryOptions) => {
    return getIncomePurpose.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::getIncomePurpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
getIncomePurpose.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getIncomePurpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncomePurpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
getIncomePurpose.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getIncomePurpose.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncomePurpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
const getIncomePurposeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncomePurpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncomePurpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
getIncomePurposeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncomePurpose.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncomePurpose
* @see app/Http/Controllers/KakeiboController.php:87
* @route '/get_income_purpose'
*/
getIncomePurposeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncomePurpose.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

getIncomePurpose.form = getIncomePurposeForm

/**
* @see \App\Http\Controllers\KakeiboController::getExpenseCategory
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
export const getExpenseCategory = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getExpenseCategory.url(options),
    method: 'get',
})

getExpenseCategory.definition = {
    methods: ["get","head"],
    url: '/get_expense_category',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::getExpenseCategory
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
getExpenseCategory.url = (options?: RouteQueryOptions) => {
    return getExpenseCategory.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::getExpenseCategory
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
getExpenseCategory.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getExpenseCategory.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpenseCategory
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
getExpenseCategory.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getExpenseCategory.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpenseCategory
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
const getExpenseCategoryForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpenseCategory.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpenseCategory
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
getExpenseCategoryForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpenseCategory.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getExpenseCategory
* @see app/Http/Controllers/KakeiboController.php:92
* @route '/get_expense_category'
*/
getExpenseCategoryForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getExpenseCategory.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

getExpenseCategory.form = getExpenseCategoryForm

/**
* @see \App\Http\Controllers\KakeiboController::getIncomeCategory
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
export const getIncomeCategory = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getIncomeCategory.url(options),
    method: 'get',
})

getIncomeCategory.definition = {
    methods: ["get","head"],
    url: '/get_income_category',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KakeiboController::getIncomeCategory
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
getIncomeCategory.url = (options?: RouteQueryOptions) => {
    return getIncomeCategory.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KakeiboController::getIncomeCategory
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
getIncomeCategory.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getIncomeCategory.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncomeCategory
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
getIncomeCategory.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getIncomeCategory.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncomeCategory
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
const getIncomeCategoryForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncomeCategory.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncomeCategory
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
getIncomeCategoryForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncomeCategory.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KakeiboController::getIncomeCategory
* @see app/Http/Controllers/KakeiboController.php:97
* @route '/get_income_category'
*/
getIncomeCategoryForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getIncomeCategory.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

getIncomeCategory.form = getIncomeCategoryForm

const KakeiboController = { renderPage, getExpense, getIncome, inputExpense, inputIncome, editExpense, editIncome, deleteExpense, deleteIncome, getExpensePurpose, getIncomePurpose, getExpenseCategory, getIncomeCategory }

export default KakeiboController