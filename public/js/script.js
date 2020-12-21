const apiUrl = "http://localhost:8000";

let cache = {};

async function request(url){
    const response = await fetch(url)
    const json = await response.json();
    return await json;
}

async function loadMap() {

	const mapboxToken = "pk.eyJ1Ijoia3VteWFrdW0iLCJhIjoiY2tpcWhhaXRlMDlnMDJ0b3pwbTNvaDl4MSJ9.PhflJtxgdetwjV3eRmG6EQ";

	const map = L.map('map').setView([0,  119.402070], 5);

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
	    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    maxZoom: 18,
	    id: 'mapbox/streets-v11',
	    tileSize: 512,
	    zoomOffset: -1,
	    accessToken: mapboxToken
	}).addTo(map);

	let geojsonFeature;

	await request("https://raw.githubusercontent.com/azharisikumbang/shape-file-indonesia/main/geoJSON/indonesia3.json")
		.then(async data => {
			geojsonFeature = await data;
		});

	let countMahasiswaPerKecamatan;

	await request(apiUrl + "/api/wilayah")
		.then(async data => {
			if(data.code == 200) {
				countMahasiswaPerKecamatan = await data.data;

				for(let i = 0; i < geojsonFeature.features.length; i++) {
					geojsonFeature.features[i].properties["kecamatan"] = geojsonFeature.features[i].properties.NAMOBJ.toUpperCase();
					geojsonFeature.features[i].properties["total"] = 0;

					countMahasiswaPerKecamatan.map(kecamatan => {
						if (
							geojsonFeature.features[i].properties.NAMOBJ.toUpperCase().replace(" ", "") === kecamatan.kecamatan.toUpperCase().replace(" ", "")
						) {
							geojsonFeature.features[i].properties = {...geojsonFeature.features[i].properties, ...kecamatan};
						} 
					});
				};

			}
		});

	setCache("geojsonFeature", geojsonFeature);

	const geoJson = await L.geoJSON(geojsonFeature, {
	    onEachFeature: function onEachFeature(feature, layer) {
	    		layer.on("click", mapClicked);
		},
		style: function(feature) {
			if (feature.properties.total > 10) {
				return { "color": "red" }
			} else if(feature.properties.total > 0) {
				return { "color" : "blue" }
			} else {
				return { "color" : "black" }
			}
		}
	}).addTo(map);
}

async function mapClicked(e){
	if (getCache("wilayah-" + e.target.feature.properties.kecamatan.toLowerCase() )) {
		return showOnPopup(getCache("wilayah-" + e.target.feature.properties.kecamatan.toLowerCase() ));
	}

	let element = document.createElement("div");

	element.append(createPopupTitle("Daftar Mahasiswa Wilayah " + e.target.feature.properties.kecamatan));

	if (e.target.feature.properties.total > 0) {
		await request(apiUrl + "/api/wilayah/" + e.target.feature.properties.kecamatan + "/mahasiswa")
			.then(async res => {
				if (res.code == 200) {
					await element.append(createMahasiswaTable(res.data));
				}
			})
	}

	setCache("popupLatestContent", element);
	setCache("wilayah-" + e.target.feature.properties.kecamatan.toLowerCase() , element);

	showOnPopup(element);
}

function showOnPopup(element) {
	let popupEl = document.getElementById("map-popup-wrapper");

	popupEl.style.opacity = 1;
	popupEl.style.zIndex = 9999;

	if (element.childNodes.length == 1) {
		element.append(document.createTextNode("Tidak Ada Data."));
	}

	popupEl.firstElementChild.innerHTML = element.outerHTML;
}

function closePopup() {
	let popupEl = document.getElementById("map-popup-wrapper");
	popupEl.style.opacity = 0;
	popupEl.style.zIndex = -1;
}

function createMahasiswaTable(data) {
	// No - Nim - Nama
	const table = document.createElement("table");
	table.classList.add("popup-table");

	let tableBody, tableBodyCell, detailLink;

	data.map((element, index) => {
		tableBody = table.insertRow();
		tableBodyCell = tableBody.insertCell();
		tableBodyCell.innerHTML = (index + 1);
		tableBodyCell = tableBody.insertCell();

		detailLink = document.createElement("a");
		detailLink.setAttribute("href", "javascript:void(0)");
		detailLink.setAttribute("onclick", "getMahasiswaDetail('" + element.nim + "')");
		detailLink.dataset.nim = element.nim;
		detailLink.innerHTML = element.nim;
		tableBodyCell.innerHTML = detailLink.outerHTML;
		tableBodyCell = tableBody.insertCell();
		tableBodyCell.innerHTML = element.nama.toUpperCase();
	});

	const tableHeader = table.createTHead();
    const tableRow = tableHeader.insertRow(0);

    let tableCell;

    tableCell = tableRow.insertCell();
    tableCell.innerHTML = "No";
    tableCell = tableRow.insertCell();
    tableCell.innerHTML = "NIM";
    tableCell = tableRow.insertCell();
    tableCell.innerHTML = "NAMA";

	return table;
}

function createPopupTitle(text) {
	const h3 = document.createElement("h3");
	h3.innerHTML = text.toUpperCase();

	return h3;
}

async function getMahasiswaDetail(nim) {
	if (getCache("mahasiswa-" + nim)) {
		return showOnPopup(getCache("mahasiswa-" + nim));
	}

	let element = document.createElement("div"); 

	await request(apiUrl + "/api/mahasiswa/" + nim)
		.then(async res => {
			if (res.code == 200) {
				await element.append(createPopupTitle("Data Dari " + res.data.nama));
				await element.append(createMahasiswaDetail(res.data))
			}
		})

	const back = document.createElement("a");
	
	back.setAttribute("href", "javascript:void(0)");
	back.setAttribute("onclick", "getPopupLatestContent()");
	back.style.marginTop = "20px";
	back.innerHTML = "Kembali";

	element.append(back);

	setCache("mahasiswa-" + nim, element);


	showOnPopup(element);
}

function createMahasiswaDetail(data){

	const table = document.createElement("table");
	table.classList.add("popup-table");

	let tableBody, tableBodyCell, detailLink;

	for (const d in data) {
		tableBody = table.insertRow();
		tableBodyCell = tableBody.insertCell();
		tableBodyCell.innerHTML = (d == "nim") ? d.toUpperCase() : d.charAt(0).toUpperCase() + d.slice(1);
		tableBodyCell.style.fontWeight = 700;
		tableBodyCell = tableBody.insertCell();
		tableBodyCell.innerHTML = (d == "email") ? data[d] : data[d].toUpperCase()
	};

	return table;
}

function getPopupLatestContent() {
	showOnPopup(getCache("popupLatestContent"));
}

function setCache(key, value) {
	cache[key] = value;
}

function getCache(key) {
	if (!cache.hasOwnProperty(key)) {
		return false;
	}

	return cache[key];
}

// menu
function toggleMenu() {
	const webMenu = document.getElementById("nav");

	if (webMenu.dataset.show == "false") {
		webMenu.dataset.show = true;
		webMenu.style.opacity = 1;
	} else {
		webMenu.dataset.show = false;
		webMenu.style.opacity = 0;
	}

}

document.addEventListener('DOMContentLoaded', function() {	
	loadMap();
});	
