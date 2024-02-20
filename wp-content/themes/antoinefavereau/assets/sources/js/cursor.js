const cursor = document.querySelector("#cursor");

let isStuck = false;
let mouse = {
    x: -100,
    y: -100,
};

let cursorOriginalState = {
    width: cursor.getBoundingClientRect().width,
    height: cursor.getBoundingClientRect().height,
};

document.body.addEventListener("pointerdown", () => {
    if (!isStuck) {
        gsap.to(cursor, 0.15, {
            scale: 2,
        });
    }
});

document.body.addEventListener("pointerup", () => {
    if (!isStuck) {
        gsap.to(cursor, 0.15, {
            scale: 1,
        });
    }
});

document.body.addEventListener("pointermove", updateCursorPosition);

document.body.addEventListener("mouseleave", (event) => {
    gsap.to(cursor, 0.15, {
        scale: 0,
    });
});
document.body.addEventListener("mouseenter", (event) => {
    gsap.to(cursor, 0.15, {
        scale: 1,
    });
});

function updateCursorPosition(e) {
    mouse.x = e.pageX - window.scrollX;
    mouse.y = e.pageY - window.scrollY;
}

function updateCursor() {
    if (!isStuck) {
        gsap.to(cursor, {
            duration: 0.15,
            x: mouse.x,
            y: mouse.y,
        });
    }

    requestAnimationFrame(updateCursor);
}

updateCursor();

document.querySelectorAll(".hover").forEach((element) => {
    element.addEventListener("mouseenter", function () {
        gsap.to(cursor, 0.15, {
            scale: 4,
            opacity: 0.8,
        });
    });

    element.addEventListener("mouseleave", function () {
        gsap.to(cursor, 0.15, {
            scale: 1,
            opacity: 1,
        });
    });
});

document.querySelectorAll(".cursorButton").forEach((button) => {
    button.addEventListener("pointerenter", handleMouseEnter);
    button.addEventListener("pointerleave", handleMouseLeave);
});

function handleMouseEnter(e) {
    gsap.to(cursor, 0.15, {
        scale: 1,
    });
    isStuck = true;
    const targetBox = e.currentTarget.getBoundingClientRect();
    gsap.to(cursor, 0.2, {
        x: targetBox.left + targetBox.width / 2,
        y: targetBox.top + targetBox.height / 2,
        width: targetBox.width + 20,
        height: targetBox.width + 20,
        borderRadius: "50%",
    });
}

function handleMouseLeave(e) {
    isStuck = false;
    gsap.to(cursor, 0.2, {
        width: cursorOriginalState.width,
        height: cursorOriginalState.width,
        borderRadius: "50%",
    });
}
