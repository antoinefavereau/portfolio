HTMLElement.prototype.ScrollingList = function (args = {}) {
    var height = args.height ? args.height : "100px"
    var speed = +(args.speed ? args.speed : "0.05") // pixels per second
    
    var scrollingListDiv = this
    var scrollingListArray = Array.from(scrollingListDiv.children)

    var logoDivContainerLeft = 0

    if (args.separator === true) {
        var separator = document.createElement("div")
        separator.classList.add("scrollingListSeparator")
        Object.assign(separator.style, {
            position: "relative",
            width: "10px",
            height: "10px",
            borderRadius: "50%",
            backgroundColor: "black",
        })

        scrollingListArray.forEach(function (element) {
            Object.assign(element.style, {
                fontFamily: "audiowide",
                fontSize: "48px",
                userSelect: "none",
                paddingInline: "20px",
            })
        })

        var newScrollingListArray = []
        scrollingListArray.forEach(function (element) {
            newScrollingListArray.push(element);
            newScrollingListArray.push(separator.cloneNode(true));
        })
        scrollingListArray = newScrollingListArray;
    }

    var scrollingListDivContainer = document.createElement("div")
    scrollingListDivContainer.classList.add("scrollingListDivContainer")
    scrollingListDiv.replaceChildren()
    scrollingListDiv.appendChild(scrollingListDivContainer)


    Object.assign(scrollingListDiv.style, {
        position: "relative",
        width: "100%",
        height: height,
        overflowX: "hidden",
    })

    Object.assign(scrollingListDivContainer.style, {
        position: "absolute",
        top: "0",
        left: "0",
        height: "100%",
        display: "flex",
        alignItems: "center",
    })


    do {
        scrollingListArray.forEach((element) => {
            scrollingListDivContainer.appendChild(element.cloneNode(true));
        });
    } while (Array.from(scrollingListDivContainer.children).at(-1).getBoundingClientRect().left <= scrollingListDiv.offsetWidth * 2)

    let lastTimestamp;
    function update(timestamp) {
        if (!lastTimestamp) lastTimestamp = timestamp;
        const elapsed = timestamp - lastTimestamp;
        const distance = elapsed * speed;
        logoDivContainerLeft -= distance
        if (Math.abs(logoDivContainerLeft) >= scrollingListDivContainer.offsetWidth / (Array.from(scrollingListDivContainer.children).length / scrollingListArray.length)) {
            logoDivContainerLeft = 0
        }
        scrollingListDivContainer.style.left = `${logoDivContainerLeft}px`;
        lastTimestamp = timestamp;
        requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
};
