<?php

App::uses('AppController', 'Controller');
App::uses('Xml', 'Utility');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

/**
 * FileUploads Controller
 *
 * @property FileUpload $FileUpload
 * @property PaginatorComponent $Paginator
 */
class FileUploadsController extends AppController {

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
        $this->FileUpload->recursive = 0;
        $this->set('fileUploads', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->FileUpload->exists($id)) {
            throw new NotFoundException(__('Invalid file upload'));
        }
        $options = array('conditions' => array('FileUpload.' . $this->FileUpload->primaryKey => $id));
        $this->set('fileUpload', $this->FileUpload->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->FileUpload->create();
            if ($this->FileUpload->save($this->request->data)) {
                $this->Flash->success(__('The file upload has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The file upload could not be saved. Please, try again.'));
            }
        }
    }

    public function adding() {
        //debug($this->request->params);
        $xml = Xml::build($this->request->params['form']['file']['tmp_name']);
        $fileData = pathinfo($this->request->params['form']['file']['name']);
        $data = array();
        foreach ($xml as $k => $contract) {
//            $originalDate = (string) $contract->Date;
//            $newDate = date("dm-Y", strtotime($originalDate));
            $data[]['FileUpload'] = array(
                'filename' => $fileData['filename'],
                'contractor' => (string) $contract->contractor,
                'author' => (string) $contract->author,
                'date' => (string) $contract->Date,
                'price' => (string) $contract->price,
                'path' => (string) $contract->path,
            );
        }
        //debug($data);
        if ($this->FileUpload->saveMany($data)) {
            echo ('Uspjeh!!');
        } else {
            echo ('Nije uspjelo');
        }
        exit();
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->FileUpload->exists($id)) {
            throw new NotFoundException(__('Invalid file upload'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->FileUpload->save($this->request->data)) {
                $this->Flash->success(__('The file upload has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The file upload could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('FileUpload.' . $this->FileUpload->primaryKey => $id));
            $this->request->data = $this->FileUpload->find('first', $options);
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
        $this->FileUpload->id = $id;
        if (!$this->FileUpload->exists()) {
            throw new NotFoundException(__('Invalid file upload'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->FileUpload->delete()) {
            $this->Flash->success(__('The file upload has been deleted.'));
        } else {
            $this->Flash->error(__('The file upload could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function formatiraj() {
        $this->autoRender = false;
//        iconv_set_encoding("input_encoding", "UTF-8");
//        iconv_set_encoding("output_encoding", "UTF-8");
//        var_dump(iconv_get_encoding('all'));
        $contracts = $this->FileUpload->find('all', array(
                'conditions' => array(
                    'FileUpload.id' => 5
                )
        ));
        
//        $q = "SHOW VARIABLES LIKE 'collation%';";
//        $db = ConnectionManager::getDataSource('default');
//        $myData = $db->query($q);
        echo $autori = $contracts[0]['FileUpload']['author'];
////    debug(mb_detect_encoding($autori, 'UTF-8')); // 'UTF-8'
////    debug(mb_detect_encoding($autori, 'UTF-8', true)); // false
////        $ime = "Š";
////        echo mb_detect_encoding($ime);
//////        //echo str_replace("Å ", "Š", $ime);
//////               echo iconv("Windows-1252//TRANSLIT", "UTF-8",$autori);
//////        //debug(($autori));
               //echo mb_convert_encoding($autori, "ISO-8859-2", "UTF-8");
   //ISO-8859-2 hrvatski
        //exit();
        foreach ($contracts as $contract) {
        //debug($contracts);exit();
            $path = ("D:\\ti-bih\\arhiva.ti-bih.org\\Anonimizirani docs\\{$contract['FileUpload']['filename']}\\");
            $savePath = ("D:\\ti-bih\\arhiva.ti-bih.org\\Prepravljeno\\");
            $newFiles = ("D:\\ti-bih\\arhiva.ti-bih.org\\New_files\\");
            

            $phpdate = strtotime( $contract['FileUpload']['date'] );
            $mysqldate = date( 'Ymd', $phpdate );
            $fajlZaPrebaciti = $path.$contract['FileUpload']['path'];echo '<br>';

            //echo '<br>';
//            $noviFajlName = $savePath.$contract['FileUpload']['contractor']
//                    . "@" . $contract['FileUpload']['id']
//                    .'.pdf';
            echo $noviFajlName = $newFiles
                    .$contract['FileUpload']['id'] ."@"
                    .$contract['FileUpload']['contractor']
                    . "@" . $contract['FileUpload']['author']
                    . "@" . $mysqldate
                    . "@" . $contract['FileUpload']['price']
                    .'.pdf';            
            $tempIme = $savePath.$contract['FileUpload']['id'].'.pdf';
            //echo '<br><br>';
            if (!file_exists($fajlZaPrebaciti)) {
                echo "<i style='color: red; font-size: 24px;'>Nije postoji ID {$contract['FileUpload']['id']}</i>";
            } else {
                echo "<i style='color: green; font-size: 24px;'>Postoji ID {$contract['FileUpload']['id']}</i>";
            }
//            
//            if (!copy($fajlZaPrebaciti, $tempIme)) {
//                echo "<i style='color: red; font-size: 24px;'>Nije prebacen ID {$contract['FileUpload']['id']}</i>";
//            } else {
//                echo "<i style='color: green; font-size: 24px;'>Prebacen ID {$contract['FileUpload']['id']}</i>";
//            }
            
            if (!copy($tempIme, $noviFajlName)) {
                echo "<i style='color: red; font-size: 24px;'>Nije preimenovan ID {$contract['FileUpload']['id']}</i>";
            } else {
                echo "<i style='color: green; font-size: 24px;'>Preimenovan ID {$contract['FileUpload']['id']}</i>";
            }
            //exit();
        }

        
        //debug($files);
    }

    public function rename() {
        $this->autoRender = false;
        
        $contracts = $this->FileUpload->find('all', array(
//            'conditions' => array(
//                'FileUpload.id' => 374
//            )
        ));
        $nodes = array();
        debug($contracts);exit();
        foreach ($contracts as $contract) {
            $nodes['contract'][] = ($contract['FileUpload']);
        }
        $d['Contracts'] = $nodes;
        $xml = Xml::build($d);
        debug($xml->asXML());exit();
//        $dir = new DirectoryIterator(dirname("D:\\ti-bih\\arhiva.ti-bih.org\\Prepravljeno\\Prepravljeno"));
//        foreach ($dir as $fileinfo) {
//            if (!$fileinfo->isDot()) {
//                //debug($fileinfo->getFilename());
//                $parent_info = $fileinfo->getPathInfo();
//                debug($parent_info->getRealPath());
//            }
//        }
    }
}
