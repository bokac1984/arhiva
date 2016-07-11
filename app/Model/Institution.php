<?php

App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

/**
 * Institution Model
 *
 * @property Contract $Contract
 */
class Institution extends AppModel {
    
    private $folderToDelete;
    
    /**
     *
     * @var string Putanja do upload foldera gdje su lokacije na disku sa trailing slash
     */
    public $realPathForLocation;
    // The Associations below have been created with all possible keys, those that are not needed can be removed

    
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        
        $this->realPathForLocation = WWW_ROOT . DS . 'uploads' . DS;
    }
    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'message' => 'This name has already been taken.'
        )
    );
    
    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Contract' => array(
            'className' => 'Contract',
            'foreignKey' => 'institution_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        
        if (isset($this->data['Institution']['name'])) {
            $name = $this->changeSerbianLetters($this->data['Institution']['name']);
            if (!file_exists($this->realPathForLocation . $name)) {
                $dir = new Folder( $this->realPathForLocation . $name, true, 0755);
            }
            $this->data['Institution']['disk_location'] = $name;
        }
    }

    public function beforeDelete($cascade = true) {
        parent::beforeDelete($cascade);
        $location = $this->diskPathForInstitution($this->id);
        
        if ($location) {
            $this->folderToDelete = $this->realPathForLocation . $location['Institution']['disk_location'];
        }
    }
    
    public function diskPathForInstitution($id = null) {
        return $this->find('first', array(
            'conditions' => array(
                'Institution.id' => $id
            ),
            'fields' => array(
                'Institution.disk_location'
            )
        ));
    }
    
    public function afterDelete() {
        parent::afterDelete();
        
        if (file_exists($this->folderToDelete)) {
            $dir = new Folder($this->folderToDelete);
            $dir->delete();
        }
        
        $this->folderToDelete = '';
    }
    
    public function createInstitution($data) {
        $this->create($data);
        
        return $this->save($data);
    }
    
    public function prepareData($fileName = '') {
        $parts = explode("@", $fileName);
        $data = array(
            'name' => $parts[0],
            'author' => $parts[1],
            'date' => $parts[2],
            'price' => $parts[3]
        );
        
        return $data;
    }
    
    public function updateInstitutionViews($viewCount = null, $id = null) {
        $data = array(
            'Institution' => array(
                'view_count' => $viewCount+1,
                'id' => $id)
        );
        
        return $this->save($data);
    }
}
