import InputController from './InputController'
import HistoryController from './HistoryController'
import MasterController from './MasterController'

const Controllers = {
    InputController: Object.assign(InputController, InputController),
    HistoryController: Object.assign(HistoryController, HistoryController),
    MasterController: Object.assign(MasterController, MasterController),
}

export default Controllers