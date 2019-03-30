<?php
/**
 * Created by IntelliJ IDEA.
 * User: UnixMan
 * Date: 30/03/2019
 * Time: 11:10
 */
class MiningTest extends CI_Controller
{
	public function index(){

		$trainingData = $this->getTrainingData();
		$testingData = $this->getTestingData();

		$lengthDataTraining = $trainingData["length"];

		for($y = 0; $y < $lengthDataTraining; $y++){

			for($z = 0; $z < 26; $z++){
				$result = abs((float)$testingData[0][$z]-(float)$trainingData[$y][$z]);
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

		//echo json_encode($listMIn);

		echo json_encode($trainingData[9484]);

		//echo json_encode($finalResult);

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
