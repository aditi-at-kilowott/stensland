document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.stn-exp__viewport').forEach(function (viewport) {

    if (viewport.dataset.expInit === '1') return;
    viewport.dataset.expInit = '1';

    const track = viewport.querySelector('.stn-exp__track');
    if (!track || !track.children.length) return;

    const visible = parseInt(viewport.dataset.visible || '3', 10);
    let animating = false;

    const stepSize = () => {
      const first = track.children[0];
      const gap   = parseFloat(getComputedStyle(track).gap) || 0;
      const h     = first.getBoundingClientRect().height;
      return h + gap;
    };

    const slideBy = (dir = 1) => {
      if (animating || track.children.length <= visible) return;
      animating = true;

      const step = stepSize();

      if (dir === 1) {
    
        track.style.transform = `translateY(-${step}px)`;

        const onEnd = () => {
          track.removeEventListener('transitionend', onEnd);
        
          track.append(track.firstElementChild);
          track.style.transition = 'none';
          track.style.transform = 'translateY(0)';
          void track.offsetHeight; 
          track.style.transition = '';
          animating = false;
        };
        track.addEventListener('transitionend', onEnd);
      } else {

        track.style.transition = 'none';
        track.prepend(track.lastElementChild);
        track.style.transform = `translateY(-${step}px)`;
        void track.offsetHeight; 
        track.style.transition = '';
        track.style.transform = 'translateY(0)';

        const onEnd = () => {
          track.removeEventListener('transitionend', onEnd);
          animating = false;
        };
        track.addEventListener('transitionend', onEnd);
      }
    };


    track.addEventListener('click', (e) => {
      if (e.target.closest('.stn-exp__item')) slideBy(1);
    });

  
    track.addEventListener('keydown', (e) => {
      if (!e.target.closest('.stn-exp__item')) return;
      if (e.key === 'Enter' || e.key === ' ')  { e.preventDefault(); slideBy(1); }
      if (e.key === 'ArrowDown')               { e.preventDefault(); slideBy(1); }
      if (e.key === 'ArrowUp')                 { e.preventDefault(); slideBy(-1); }
    });

  
    window.addEventListener('resize', () => { void track.offsetHeight; });
  });
});