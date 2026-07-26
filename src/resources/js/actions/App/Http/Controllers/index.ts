import InputController from './InputController'
import HistoryController from './HistoryController'

const Controllers = {
    InputController: Object.assign(InputController, InputController),
    HistoryController: Object.assign(HistoryController, HistoryController),
}

export default Controllers