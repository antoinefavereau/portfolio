HTMLElement.prototype.ScrollingList = function (args = {}) {
    var height = args.height ? args.height : "100px"
    var speed = +(args.speed ? args.speed : "0.05") // pixels per second
    var scrollingListDiv = this
    var scrollingListArray = Array.from(scrollingListDiv.children)
    var scrollingListDivContainer = document.createElement("div")
    var logoDivContainerLeft = 0
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

    var logoDivContainerWidth = 0

    do {
        let first = scrollingListDivContainer.children.length == 0
        scrollingListArray.forEach((element) => {
            scrollingListDivContainer.appendChild(element.cloneNode(true));
        });
        if (first) {
            logoDivContainerWidth = scrollingListDivContainer.offsetWidth
        }
    } while (Array.from(scrollingListDivContainer.children).at(-1).getBoundingClientRect().left <= scrollingListDiv.offsetWidth)

    let lastTimestamp;
    function update(timestamp) {
        if (!lastTimestamp) lastTimestamp = timestamp;
        const elapsed = timestamp - lastTimestamp;
        const distance = elapsed * speed;
        logoDivContainerLeft -= distance
        if (Math.abs(logoDivContainerLeft) >= logoDivContainerWidth) {
            logoDivContainerLeft = 0
        }
        scrollingListDivContainer.style.left = `${logoDivContainerLeft}px`;
        lastTimestamp = timestamp;
        requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
};
