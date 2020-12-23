const apiUrl = "http://localhost:8000";

const color = Chart.helpers.color;

async function request(url){
    const response = await fetch(url)
    const json = await response.json();
    return await json;
}

function loadYearChart() {
	request(apiUrl + "/api/chart")
		.then(res => {
			if (res.code === 200) {
				let colors = [];

				const data = res.data.map((d, index) => {
					return d.total;
				})

				const key = res.data.map(d => {
					return d.tahun;
				})

				const ctx = document.getElementById('yearChart').getContext('2d');
				const yearChart = new Chart(ctx, {
				    type: 'line',
				    data: {
				        labels: key,
				        datasets: [{
				            label: "Pertumbuhan Mahasiswa",
				            data: data,
				            backgroundColor: color("red").alpha(0.2).rgbString(),
				            // fill: false,
				            borderColor: [
				                'rgba(255, 99, 132, 1)',
				            ],
				            borderWidth: 2
				        }]
				    },
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        }
				    }
				});

			}
		})
}


// Wilayahchart
function loadWilayahChart() {
	const ctx = document.getElementById('wilayahChart').getContext('2d');
	const wilayahChart = new Chart(ctx, {
	    type: 'horizontalBar',
	    data: {
	        labels: [],
	        datasets: [{
	            label: "Pertumbuhan Mahasiswa",
	            data: [],
	            backgroundColor: color("blue").alpha(0.6).rgbString(),
	            borderWidth: 2
	        }]
	    },
	    options: {
	        scales: {
	            xAxes: [{
	                ticks: {
	                	min: 0,
						suggestedMax: 10,
	                	stepSize: 2,
	                    beginAtZero: true
	                }
	            }]
	        }
	    }
	});

	return wilayahChart;
}


function updateWilayahChartByYear(year) {
	request(apiUrl + "/api/chart/" + year )
		.then(async res => {
			
		const wilayahData = await res.data.map((d, index) => {
			return d.total;
		})

		const wilayahKey = await res.data.map(d => {
			return d.kecamatan;
		})

		wilayahChart = await loadWilayahChart();

		wilayahChart.data.datasets[0].data = wilayahData;
		wilayahChart.data.labels = wilayahKey;
		wilayahChart.update();
	})
}

// WilayahByYear
function loadWilayahByYearChart() {
	const ctx = document.getElementById('wilayahByYearChart').getContext('2d');
	const wilayahByYearChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: [],
	        datasets: [{
	            label: "Pertumbuhan Mahasiswa",
	            data: [],
	            backgroundColor: color("blue").alpha(0.6).rgbString(),
	            borderWidth: 2
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                	min: 0,
						suggestedMax: 10,
	                	stepSize: 2,
	                    beginAtZero: true
	                }
	            }]
	        }
	    }
	});

	return wilayahByYearChart;
}

function updateYearByWilayah(kecamatan) {
	request(apiUrl + "/api/chart/" + kecamatan + "/year" )
		.then(async res => {

		// let wilayahByChartData = {key };
		let keys = [];
		let data = [];

		for (key in res.data) {
			keys.push(key);
			data.push(res.data[key].total);
		}

		wilayahByChart = await loadWilayahByYearChart();

		wilayahByChart.data.datasets[0].data = data;
		wilayahByChart.data.labels = keys;
		wilayahByChart.update();
	})
	
}


document.addEventListener('DOMContentLoaded', function() {	
	const now = new Date();

	loadYearChart();
	updateWilayahChartByYear(now.getFullYear());
	updateYearByWilayah(1);
});	


