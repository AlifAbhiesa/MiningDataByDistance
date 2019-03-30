<?php
/**
 * Created by IntelliJ IDEA.
 * User: UnixMan
 * Date: 30/03/2019
 * Time: 8:53
 */

?>

<html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
Prediksi Data
<select id="data" onchange="getOne()">
	<?php for($i = 0; $i < 6998; $i++){ ?>
		<option value="<?= $i ?>">Data Ke - <?= $i ?></option>
	<?php } ?>
</select>
<br>
T1	 = <label id="T1"></label><br>
RH_1 = <label id="RH_1"></label><br>
T2	= <label id="T2"></label><br>
RH_2	= <label id="RH_2"></label><br>
T3	= <label id="T3"></label><br>
RH_3	= <label id="RH_3"></label><br>
T4	= <label id="T4"></label><br>
RH_4	= <label id="RH_4"></label><br>
T5	= <label id="T5"></label><br>
RH_5	= <label id="RH_5"></label><br>
T6	= <label id="T6"></label><br>
RH_6	= <label id="RH_6"></label><br>
T7	= <label id="T7"></label><br>
RH_7	= <label id="RH_7"></label><br>
T8	= <label id="T8"></label><br>
RH_8	= <label id="RH_8"></label><br>
T9	= <label id="T9"></label><br>
RH_9	= <label id="RH_9"></label><br>
T_out	= <label id="T_out"></label><br>
Press_mm_hg	= <label id="Press_mm_hg"></label><br>
RH_out	= <label id="RH_out"></label><br>
Windspeed	= <label id="Windspeed"></label><br>
Visibility	= <label id="Visibility"></label><br>
Tdewpoint	= <label id="Tdewpoint"></label><br>
rv1	= <label id="rv1"></label><br>
rv2	= <label id="rv2"></label><br>
<hr>
<b>Pediction Result</b><br>
Appliances	= <label id="Appliances"></label><br>
lights = <label id="lights"></label><br>

</html>

<script>

	function getOne() {

		id = document.getElementById("data").value;
		$.ajax({
			url: "<?php echo base_url('Mining/getPrediction'); ?>",
			type: "post",
			data: {dataNumber:id},
			cache: false,
			success: function (response) {
				if(response != ""){
					response = JSON.parse(response);
					console.log(response);
					document.getElementById("T1").innerText = response[0][0];
					document.getElementById("RH_1").innerText = response[0][1];
					document.getElementById("T2").innerText = response[0][2];
					document.getElementById("RH_2").innerText = response[0][3];
					document.getElementById("T3").innerText = response[0][4];
					document.getElementById("RH_3").innerText = response[0][5];
					document.getElementById("T4").innerText = response[0][6];
					document.getElementById("RH_4").innerText = response[0][7];
					document.getElementById("T5").innerText = response[0][8];
					document.getElementById("RH_5").innerText = response[0][9];
					document.getElementById("T6").innerText = response[0][10];
					document.getElementById("RH_6").innerText = response[0][11];
					document.getElementById("T7").innerText = response[0][12];
					document.getElementById("RH_7").innerText = response[0][13];
					document.getElementById("T8").innerText = response[0][14];
					document.getElementById("RH_8").innerText = response[0][15];
					document.getElementById("T9").innerText = response[0][16];
					document.getElementById("RH_9").innerText = response[0][18];
					document.getElementById("T_out").innerText = response[0][19];
					document.getElementById("Press_mm_hg").innerText = response[0][20];
					document.getElementById("Windspeed").innerText = response[0][21];
					document.getElementById("Visibility").innerText = response[0][22];
					document.getElementById("Tdewpoint").innerText = response[0][23];
					document.getElementById("rv1").innerText = response[0][24];
					document.getElementById("rv2").innerText = response[0][25];
					document.getElementById("Appliances").innerText = response[0][26];
					document.getElementById("lights").innerText = response[0][27];

				}else{
					alert("Error !");
				}
			}
		});
	}

</script>
