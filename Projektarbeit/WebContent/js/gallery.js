function openLightbox(imgElem) {
    var lb = document.getElementById('lightbox');
    var lbImg = document.getElementById('lightbox-img');
    var lbCaption = document.getElementById('lightbox-caption');
    var src = imgElem.getAttribute('data-full') || imgElem.src;
    lbImg.src = src;
    lbImg.alt = imgElem.alt || '';
    lbCaption.textContent = imgElem.getAttribute('alt') || '';
    lb.classList.add('open');
}

function closeLightbox(e) {
    if (e && e.target && (e.target.id === 'lightbox' || e.target.classList.contains('close'))) {
        var lb = document.getElementById('lightbox');
        lb.classList.remove('open');
        var lbImg = document.getElementById('lightbox-img');
        lbImg.src = '';
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        var lb = document.getElementById('lightbox');
        if (lb && lb.classList.contains('open')) {
            lb.classList.remove('open');
            document.getElementById('lightbox-img').src = '';
        }
    }
});

// Progressive enhancement: ensure images have loading=lazy where supported
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.gallery-grid img').forEach(function(img){
        if (!img.hasAttribute('loading')) img.setAttribute('loading','lazy');
    });
});
