const apiUrl = window.location.origin;

async function request(url){
    const response = await fetch(url)
    const json = await response.json();
    return await json;
}


const formMahasiswaProvinsiChoices = document.getElementById("Mahasiswa_kecamatan_provinsi");

formMahasiswaProvinsiChoices.onchange = function(e) {
	provinsi = e.target.value;

	request(apiUrl + "/api/wilayah/provinsi/" + provinsi)
		.then(async res => {
			if (res.code == 200) {
				const selectParent = document.createElement("select");
				
				await res.data.map((d, index) => {
					option = document.createElement("option");
					option.value = d.kabupaten.toUpperCase();
					option.innerHTML = d.kabupaten.toUpperCase();
					selectParent.append(option);
				});
				
				const parent = document.getElementById("Mahasiswa_kecamatan_kabupaten");
				replaceFormSelectChildren(selectParent, parent);
				removeFormDisabled(parent);
			}
		})
}

const formMahasiswaKabupatenChoices = document.getElementById("Mahasiswa_kecamatan_kabupaten");

formMahasiswaKabupatenChoices.onchange = function(e) {
	kabupaten = e.target.value;

	request(apiUrl + "/api/wilayah/kabupaten/" + kabupaten)
		.then(async res => {
			if (res.code == 200) {
				const selectParent = document.createElement("select");
				
				await res.data.map((d, index) => {
					option = document.createElement("option");
					option.value = d.kecamatan.toUpperCase();
					option.innerHTML = d.kecamatan.toUpperCase();
					selectParent.append(option);
				});
				
				const parent = document.getElementById("Mahasiswa_kecamatan_kecamatan");
				replaceFormSelectChildren(selectParent, parent);
				removeFormDisabled(parent)
			}
		})
}

function replaceFormSelectChildren(children, parent) 
{
	parent.replaceChildren(...children);
}

function removeFormDisabled(element) {
	element.disabled = false;
}

let cache = {}

