document.addEventListener('DOMContentLoaded', () => {
    // Initialize Plyr.js
    const player = new Plyr('#player', {
        autoplay: true,
    });

    // Open Video Modal
    document.querySelectorAll('.popup-video').forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior
            const videoUrl = this.getAttribute('data-video');
            const iframe = document.querySelector('#player iframe');
            iframe.src = `${videoUrl}?autoplay=1`;
            document.getElementById('videoModal').style.display = 'flex'; // Show modal
        });
    });

    // Close Video Modal by clicking outside the video
    const modal = document.getElementById('videoModal');
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeVideo();
        }
    });

    // Close Video Modal function
    window.closeVideo = function () {
        const iframe = document.querySelector('#player iframe');
        iframe.src = ''; // Clear video source to stop playback
        document.getElementById('videoModal').style.display = 'none'; // Hide modal
    };
});