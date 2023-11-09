        var togglerBtn = document.querySelector(".switch");
        var mainContainer = document.querySelector(".container");
        var sidebarContainer = document.querySelector(".sidebar");
        var modeToggleContainer = document.querySelector(".mode");
        var heroContainer = document.querySelector(".hero-container");
        var modeText = document.querySelector(".mode-text");
        var searchBtn = document.querySelector(".search-box");
        var closeSidebar = document.querySelector(".close-bar");
        var rightSidebar = document.querySelector(".right-sidebar");
        var scrollbarItem = document.querySelectorAll(".scrollbar-item");
        var timeBar = document.querySelector(".time-bar");
        var progressBar = document.querySelector(".progress-bar");
        var awardBar = document.querySelector(".award-bar");
        var showcaseData = document.querySelectorAll(".showcase-data");
        var barContent = document.querySelectorAll(".bar-content");
        var showcaseRightSide = document.querySelector(".showcase-rightside");
        togglerBtn.addEventListener("click", () => {
            togglerBtn.classList.toggle("active");
            mainContainer.classList.toggle("active");
            
            sidebarContainer.classList.toggle("dark-mode");
            modeToggleContainer.classList.toggle("dark-mode");
            modeText.classList.toggle("dark-mode");
            searchBtn.classList.toggle("dark-mode");

            rightSidebar.classList.toggle("active");
            timeBar.classList.toggle("active");
            progressBar.classList.toggle("active");
            heroContainer.classList.toggle("active");
            awardBar.classList.toggle("active");
            scrollbarItem.forEach((item) => {
                item.classList.toggle("active");
            });
            
            showcaseData.forEach((item) => {
                item.classList.toggle("active");
            });
            
            barContent.forEach((item) => {
                item.classList.toggle("active");
            });
            showcaseRightSide.classList.toggle("active");
        });
        closeSidebar.addEventListener("click", () => {
            sidebarContainer.classList.toggle("close");
        });


// Game Data
        var gamesData = [
            {
                imageSrc: "images/game/one.jpg",
                title: "The Rocket Launcher",
                description: "Information about the game notification",
            },
            {
                imageSrc: "images/game/two.jpg",
                title: "Mining Artificial Intelligence",
                description: "Information about the game notification",
            },
            {
                imageSrc: "images/game/three.jpg",
                title: "Forza Machine Router",
                description: "Information about the game notification",
            },
            {
                imageSrc: "images/game/four.jpg",
                title: "Gold Mining Strategy",
                description: "Information about the game notification",
            },
            {
                imageSrc: "images/game/five.jpg",
                title: "Wordscape",
                description: "Information about the game notification",
            },
            {
                imageSrc: "images/game/six.jpg",
                title: "WordZee",
                description: "Information about the game notification",
            },
        ];
        var gameScrollbar = document.querySelector(".game-scrollbar");
        gamesData.forEach((game) => {
            var gameItem = document.createElement("div");
            gameItem.classList.add("scrollbar-item");
            gameItem.innerHTML = `
                <div class="game-item">
                    <div class="game-img">
                        <img src="${game.imageSrc}">
                    </div>
                    <div class="game-content">
                        <h3 class="scroll-content-heading">
                            ${game.title}
                            <i class='bx bx-right-arrow-alt'></i>
                        </h3>
                        <p>${game.description}</p>
                    </div>
                </div>
            `;
            gameScrollbar.appendChild(gameItem);
        });


// Update Date

var updateData = [
    {
        imageSrc: "images/game/update.jpg",
        title: "3d Renderer Image",
        description: "Information about the update notification",
    },
    {
        imageSrc: "images/game/updated.jpg",
        title: "Pickart Image & Standards",
        description: "Information about the update notification",
    },
    {
        imageSrc: "images/game/updateter.jpg",
        title: "Weather",
        description: "Information about the update notification",
    },
];
var updateScrollbar = document.querySelector(".update-scrollbar");
updateData.forEach((update) => {
    var scrollbarItem = document.createElement("div");
    scrollbarItem.classList.add("scrollbar-item");

    scrollbarItem.innerHTML = `
        <div class="game-item">
            <div class="game-img">
                <img src="${update.imageSrc}">
            </div>
            <div class="game-content">
                <h3 class="scroll-content-heading">
                    ${update.title}
                    <i class='bx bx-right-arrow-alt'></i>
                </h3>
                <p>${update.description}</p>
            </div>
        </div>
    `;
    updateScrollbar.appendChild(scrollbarItem);
});


// Friends Data
var friendsData = [
    {
        name: "Chris Ham's",
        imageSrc: "images/game/profile.jpg",
        description: "Information to be shown about Chris Ham's"
    },
    {
        name: "Designer Micheal",
        imageSrc: "images/game/profileavatar.jpg",
        description: "Information to be shown about Designer Micheal"
    },
    {
        name: "Chinese Gangster Yuoung",
        imageSrc: "images/game/profilegangster.jpg",
        description: "Information to be shown about Chinese Gangster Yuoung"
    },
    {
        name: "John Wick",
        imageSrc: "images/game/profilejohn.jpg",
        description: "Information to be shown about John Wick"
    },
    {
        name: "Sam Smith",
        imageSrc: "images/game/profilesam.jpg",
        description: "Information to be shown about Sam Smith"
    }
];

var friendsScrollbar = document.querySelector(".friends-scrollbar");
friendsData.forEach((friend) => {
    var scrollbarItem = document.createElement("div");
    scrollbarItem.classList.add("scrollbar-item");

    scrollbarItem.innerHTML = `
        <div class="game-item">
            <div class="game-img">
                <img src="${friend.imageSrc}">
            </div>
            <div class="game-content">
                <h3 class="scroll-content-heading">
                    ${friend.name}
                    <i class='bx bx-right-arrow-alt'></i>
                </h3>
                <p>${friend.description}</p>
            </div>
        </div>
    `;

    friendsScrollbar.appendChild(scrollbarItem);
});



// Content Data Update

var container = document.querySelector(".bar-scroll-content");
var maximizerBtn = document.querySelector(".maximizer");
var maximizerContainer = document.querySelector(".bar-maximizer-container");
var maximizedDataStore = document.querySelector(".bar-scroll-content.maximizer");

maximizerBtn.addEventListener("click", function (e) {
    if (maximizerContainer.style.display === "none") {
        maximizerContainer.style.display = "block";
    } else {
        maximizerContainer.style.display = "none";
    }
});

function closeForm() {
    maximizerContainer.style.display = "none";
}
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
                </div>
            </div>
            <div class="bar-date">
                <p>${item.date}</p> <!-- You need to have a 'date' key in your JSON to access it -->
            </div>
            <button type="button" class="bar-cta">${item.gbtnlabel}</button>
        `;
        container.appendChild(contentItem);
        var maximizerContentItem = contentItem.cloneNode(true);
        maximizerContentItem.classList.add("maximizer");
        maximizedDataStore.appendChild(maximizerContentItem);
    });
})
.catch(error => {
    console.error('Error fetching data:', error);
});