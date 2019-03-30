<?php
/**
 * Created by IntelliJ IDEA.
 * User: UnixMan
 * Date: 26/03/2019
 * Time: 14:08
 */

class Mining extends CI_Controller
{
	public function index(){

		$this->load->view('page_select');
	}

	public function getPrediction(){

		$dataNumber = $_POST['dataNumber'];
		$result[] = $this->predict($dataNumber);
		echo json_encode($result);
	}

	public function predict($dataNumber){

		$dataTraining = $this->getTrainingData();
		$dataTesting = $this->getTestingData();

		$lengthDataTraining = $dataTraining["length"];

		for($y = 0; $y < $lengthDataTraining; $y++){

			for($z = 0; $z < 26; $z++){
				$result = abs((float)$dataTesting[$dataNumber][$z]-(float)$dataTraining[$y][$z]);
			}
			$finalResult[] = sqrt($result);
		}

		$min = min($finalResult);
		$listMIn = array();
		for($i = 0; $i< $lengthDataTraining; $i++){
			if($finalResult[$i] == $min){
				$listMIn[] = $finalResult[$i];
				$listMIn['keyArray'][] = $i;
			}
		}

		$final = $this->setValueOfPredict($listMIn,$dataNumber);

		return $final;

	}

	public function setValueOfPredict($dataNumberTraining,$dataNumberTesting){
		$dataTesting = $this->getTestingData();
		$dataTraining = $this->getTrainingData();

		$appliances = $dataTraining[$dataNumberTraining['keyArray'][0]][26];
		$light = $dataTraining[$dataNumberTraining['keyArray'][0]][27];
//
		$dataTesting[$dataNumberTesting][] += $appliances;
		$dataTesting[$dataNumberTesting][] += $light;


		return $dataTesting[$dataNumberTesting];

	}

	public function getTrainingData(){
		$x = file(base_url('training-data.csv'), FILE_SKIP_EMPTY_LINES);
		$h = fopen(base_url('training-data.csv'), "r");
		$data = fgetcsv($h, count($x), ",");
		while (($data = fgetcsv($h, count($x), ",")) !== FALSE)
		{
			$datasetsTraining[] = $data;
		}
		fclose($h);

		$datasetsTraining['length'] = count($x)-1;

		return $datasetsTraining;
	}

	public function getTestingData(){
		$x = file(base_url('testing-data.csv'), FILE_SKIP_EMPTY_LINES);
		$h = fopen(base_url('testing-data.csv'), "r");
		$data = fgetcsv($h, count($x), ",");
		while (($data = fgetcsv($h, count($x), ",")) !== FALSE)
		{
			$datasetsTesting[] = $data;
		}
		fclose($h);
		$datasetsTesting['length'] = count($x)-1;


		return $datasetsTesting;
	}


}
