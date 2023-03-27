window.onload = function () {
    Particles.init({
        selector: ".background"
    });
};
const particles = Particles.init({
    selector: ".background",
    color: ["#03dac6", "#ff0266", "#000000"],
    connectParticles: true,
});