document.addEventListener("DOMContentLoaded", function() {
    const emojis = ["🐶", "🐱", "🐾", "🐰", "🦴", "🐦", "🐢", "🐕", "🐈"];
    const emojiBg = document.getElementById("emoji-bg");
    const emojiCount = 36;

    function randomBetween(a, b) {
        return Math.random() * (b - a) + a;
    }

    for (let i = 0; i < emojiCount; i++) {
        const span = document.createElement("span");
        span.className = "emoji-float";
        span.textContent = emojis[Math.floor(Math.random() * emojis.length)];
        span.style.top = randomBetween(0, 90) + "vh";
        span.style.left = "-8vw";
        span.style.fontSize = randomBetween(3, 5.5) + "rem";
        span.style.opacity = randomBetween(0.1, 0.6);
        emojiBg.appendChild(span);

        const duration = randomBetween(12, 28);
        span.animate([
            { transform: `translateX(0vw)` },
            { transform: `translateX(116vw)` }
        ], {
            duration: duration * 1000,
            iterations: Infinity,
            delay: randomBetween(0, 10000)
        });
    }

    document.querySelectorAll('.btn-animado').forEach(btn => {
        if (!btn.closest('.dropdown-menu')) {
            btn.addEventListener('click', function(e) {
                if (btn.tagName === 'A') {
                    e.preventDefault();
                    btn.classList.add('clicked');
                    setTimeout(() => {
                        btn.classList.remove('clicked');
                        window.location.href = btn.href;
                    }, 220);
                }
            });
        }
    });
});
