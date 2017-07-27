<?php
App::uses('AppController', 'Controller');
/**
 * SettingSections Controller
 *
 * @property SettingSection $SettingSection
 * @property PaginatorComponent $Paginator
 */
class SettingSectionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SettingSection->recursive = 0;
		$this->set('settingSections', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SettingSection->exists($id)) {
			throw new NotFoundException(__('Invalid setting section'));
		}
		$options = array('conditions' => array('SettingSection.' . $this->SettingSection->primaryKey => $id));
		$this->set('settingSection', $this->SettingSection->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SettingSection->create();
			if ($this->SettingSection->save($this->request->data)) {
				$this->Flash->success(__('The setting section has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The setting section could not be saved. Please, try again.'));
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
		if (!$this->SettingSection->exists($id)) {
			throw new NotFoundException(__('Invalid setting section'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SettingSection->save($this->request->data)) {
				$this->Flash->success(__('The setting section has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The setting section could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SettingSection.' . $this->SettingSection->primaryKey => $id));
			$this->request->data = $this->SettingSection->find('first', $options);
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
		$this->SettingSection->id = $id;
		if (!$this->SettingSection->exists()) {
			throw new NotFoundException(__('Invalid setting section'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SettingSection->delete()) {
			$this->Flash->success(__('The setting section has been deleted.'));
		} else {
			$this->Flash->error(__('The setting section could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
