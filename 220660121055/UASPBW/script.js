// Mendapatkan elemen canvas
const canvas = document.getElementById("backgroundCanvas");
const ctx = canvas.getContext("2d");

// Warna-warna yang digunakan
let colors = ["#FF5733", "#33FF57", "#3357FF", "#FF33A1", "#FFF733"];
let particles = [];
let canvasWidth = canvas.width = window.innerWidth;
let canvasHeight = canvas.height = window.innerHeight;

// Kelas Partikel
class Particle {
    constructor() {
        this.x = Math.random() * canvasWidth;
        this.y = Math.random() * canvasHeight;
        this.size = Math.random() * 4 + 1;
        this.color = colors[Math.floor(Math.random() * colors.length)];
        this.speedX = Math.random() * 2 - 1;
        this.speedY = Math.random() * 2 - 1;
    }

    // Menggambar partikel
    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.fill();
    }

    // Memperbarui posisi partikel
    update() {
        this.x += this.speedX;
        this.y += this.speedY;

        // Membalik arah jika partikel keluar layar
        if (this.x < 0 || this.x > canvasWidth) this.speedX *= -1;
        if (this.y < 0 || this.y > canvasHeight) this.speedY *= -1;
    }
}

// Membuat partikel
function initParticles() {
    for (let i = 0; i < 100; i++) {
        particles.push(new Particle());
    }
}

// Animasi partikel
function animate() {
    ctx.clearRect(0, 0, canvasWidth, canvasHeight);
    particles.forEach((particle) => {
        particle.update();
        particle.draw();
    });
    requestAnimationFrame(animate);
}

// Mengatur ulang ukuran canvas saat layar berubah
window.addEventListener("resize", () => {
    canvasWidth = canvas.width = window.innerWidth;
    canvasHeight = canvas.height = window.innerHeight;
    particles = [];
    initParticles();
});

// Memulai
initParticles();
animate();
