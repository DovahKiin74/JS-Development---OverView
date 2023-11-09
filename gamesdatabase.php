<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameDatabase</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="gamesdatabase.css">
</head>
<body>
<div id="main-container">
    <h1>Your Database</h1>
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search for games">
    </div>
    <div id="data-container"></div>
    <div class="filter-buttons">
        <i class="bx bx-filter-alt filter-toggle"></i>
        <ul class="filter-buttons-area">
            <li>
                <a class="filter-button" data-filter-criteria="Consoles">Consoles</a>
            </li>
            <li>
                <a class="filter-button" data-filter-criteria="Download Now">Download Now</a>
            </li>
            <li>
                <a class="filter-button" data-filter-criteria="Buy Now">Buy Now</a>
            </li>
            <li>
                <a class="filter-button" data-filter-criteria="Android">Android</a>
            </li>
            <li>
                <a class="filter-button" data-filter-criteria="Windows">Windows</a>
            </li>
        </ul>
    </div>
</div>

<script>
var container = document.getElementById('data-container');
    fetch('games.json')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        data.forEach(item => {
            var contentItem = document.createElement("div");
            contentItem.className = "bar-content";

            contentItem.innerHTML = `
                <div class="bar-info">
                    <div class="bar-img">
                        <img src="${item.gimgsrc}">
                    </div>
                    <div class="bar-information">
                        <div class="bar-name">
                            ${item.gname}
                        </div>
                        <div class="game-data">
                            <p>${item.gdescrip}</p>
                        </div>
                        <button type="button" class="bar-cta">${item.gbtnlabel}</button>
                    </div>
                </div>
            `;
            container.appendChild(contentItem);
    });
});
document.addEventListener('DOMContentLoaded', function () {
    var filterButtons = document.querySelectorAll('.filter-button');
    var filterToggle = document.querySelector('.filter-toggle');
    var gamesData = [];
    
    // Add a click event listener to the filter toggle element
    filterToggle.addEventListener('click', function() {
        var filterButtonsArea = document.querySelector(".filter-buttons-area");
        if (filterButtonsArea.style.display === 'none') {
            filterButtonsArea.style.display = 'block';
        } else {
            filterButtonsArea.style.display = 'none';
        }
    });
    var filterFunctions = {
        'Download Now': (item) => item.gbtnlabel.includes('Download Now'),
        'Buy Now': (item) => item.gbtnlabel.includes('Buy Now'),
        'Consoles': (item) => item.gdescrip.includes('consoles'),
        'Android': (item) => item.gdescrip.includes('Android'),
        'Windows': (item) => item.gdescrip.includes('Windows'),
    };
    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            var filterCriteria = this.dataset.filterCriteria;
            fetch('games.json')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    filterAndDisplayGames(data, filterCriteria, filterFunctions);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });
    });
    function filterAndDisplayGames(data, filterCriteria, filterFunctions) {
        var container = document.getElementById('data-container');
        container.innerHTML = '';
        data.forEach(item => {
            if (filterFunctions[filterCriteria](item)) {
                var contentItem = document.createElement("div");
                contentItem.className = "bar-content";

                contentItem.innerHTML = `
                    <div class="bar-info">
                        <div class="bar-img">
                            <img src="${item.gimgsrc}">
                        </div>
                        <div class="bar-information">
                            <div class="bar-name">
                                ${item.gname}
                            </div>
                            <div class="game-data">
                                <p>${item.gdescrip}</p>
                            </div>
                            <button type="button" class="bar-cta">${item.gbtnlabel}</button>
                        </div>
                    </div>
                `;
                container.appendChild(contentItem);
            }
        });
    }
});
</script>
</body>
</html>
