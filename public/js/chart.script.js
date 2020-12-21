const apiUrl = "http://localhost:8000";

async function request(url){
    const response = await fetch(url)
    const json = await response.json();
    return await json;
}


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

			console.log(colors)

			const ctx = document.getElementById('yearChart').getContext('2d');
			const yearChart = new Chart(ctx, {
			    type: 'line',
			    data: {
			        labels: key,
			        datasets: [{
			            label: "Pertumbuhan Mahasiswa",
			            data: data,
			            backgroundColor: "red",
			            fill: false,
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

