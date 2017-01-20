<?php
App::uses('ErrorManagerAppController', 'ErrorManager.Controller');
/**
 * UserMessages Controller
 *
 * @property UserMessage $UserMessage
 */
class UserMessagesController extends ErrorManagerAppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserMessage->recursive = 0;
		$this->set('userMessages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserMessage->exists($id)) {
			throw new NotFoundException(__('Invalid user message'));
		}
		$options = array('conditions' => array('UserMessage.' . $this->UserMessage->primaryKey => $id));
		$this->set('userMessage', $this->UserMessage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserMessage->create();
			if ($this->UserMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The user message has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user message could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserMessage->exists($id)) {
			throw new NotFoundException(__('Invalid user message'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The user message has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserMessage.' . $this->UserMessage->primaryKey => $id));
			$this->request->data = $this->UserMessage->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserMessage->id = $id;
		if (!$this->UserMessage->exists()) {
			throw new NotFoundException(__('Invalid user message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserMessage->delete()) {
			$this->Session->setFlash(__('User message deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User message was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
