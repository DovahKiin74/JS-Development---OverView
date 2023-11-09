fetch('node.json')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const container = document.getElementById('data-container');
        data.forEach(item => {
            var contentItem = document.createElement("div");
            contentItem.className = "bar-content";

            contentItem.innerHTML = `
                <div class="bar-info">
                    <div class="bar-img">
                        <img src="${item.imgSrc}">
                    </div>
                    <div class="bar-information">
                        <div class="bar-name">
                            ${item.name}
                        </div>
                        <div class="game-data">
                            <p>${item.description}</p>
                        </div>
                    </div>
                </div>
                <div class="bar-date">
                    <p>${item.date}</p>
                </div>
                <button type="button" class="bar-cta">${item.buttonLabel}</button>
            `;
            container.appendChild(contentItem);

            // Clone the regular .bar-content element and add .maximizer class
            var maximizerContentItem = contentItem.cloneNode(true);
            maximizerContentItem.classList.add("maximizer");
            maximizedDataStore.appendChild(maximizerContentItem);
        });
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });