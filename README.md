# Project Description

A map-bsed visualization for student's home address distribution grouped by 'kecamatan' (Indonesian administration name for 'District'). There are three clasification for distribution with different color. It will be good option to plan targetted promotion to gain new students. 

# Features

- [x] Authentication (admin only)
- [x] Add new locations (Provinsi/Province, Kota/City, Kecamatan/Disctrict)
- [x] Add new student data
- [x] Map-based visualization
- [x] Authorization for seeing protected data on map
- [x] Yearly distribution chart
- [x] Top 10 location chart by year 
- [x] Yearly distribution chart for selected location
- [ ] TopoJSON uploader
- [ ] Customable map classification and indicator
- [ ] Map with rich charts

# Tech Stack

- PHP >= 7.2
- Symfony 5.2
- LeafletJS with Mapbox
- ChartJS

# Installation

```bash
git clone https://github.com/azharisikumbang/webgis
cd webgis

composer install

# Don't forget to copy and setting the .env file for databases, etc.
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console server:start
```

