(() => {
  const SELECTORS = {
    wrap: '.stn-projects',
    bar:  '.stn-tabs',
    tab:  '.stn-tab',
    panel:'.stn-panel'
  };

  function activateTab(wrap, tabBtn) {
    const tabs   = Array.from(wrap.querySelectorAll(SELECTORS.tab));
    const panels = Array.from(wrap.querySelectorAll(SELECTORS.panel));
    const target = tabBtn?.dataset?.target; 
    
    tabs.forEach(t => {
      const on = t === tabBtn;
      t.classList.toggle('is-active', on);
      t.setAttribute('aria-selected', on ? 'true' : 'false');
      t.tabIndex = on ? 0 : -1;
    });


    panels.forEach(p => {
      const show = target && ('#' + p.id) === target;
      p.classList.toggle('is-active', show);
      if (show) p.removeAttribute('hidden');
      else p.setAttribute('hidden', '');
    });
  }

  function initBlock(wrap) {
    const bar  = wrap.querySelector(SELECTORS.bar);
    if (!bar) return;

    const tabs = Array.from(bar.querySelectorAll(SELECTORS.tab));
    if (!tabs.length) return;


    bar.setAttribute('role', 'tablist');
    tabs.forEach((t, i) => {
      t.setAttribute('role', 'tab');
      t.tabIndex = -1; 
      const target = t.dataset.target?.replace('#', '') || '';
      if (target) {
        const panel = wrap.querySelector('#' + target);
        if (panel) {
          panel.setAttribute('role', 'tabpanel');
          panel.setAttribute('aria-labelledby', t.id || `tab-${i}`);
          if (!t.id) t.id = `tab-${i}`;
        }
      }
    });

    bar.addEventListener('click', (e) => {
      const btn = e.target.closest(SELECTORS.tab);
      if (!btn) return;
      e.preventDefault();
      activateTab(wrap, btn);
      btn.focus();
    });

    bar.addEventListener('keydown', (e) => {
      const current = e.target.closest(SELECTORS.tab);
      if (!current) return;

      const idx = tabs.indexOf(current);
      let nextIdx = idx;

      switch (e.key) {
        case 'ArrowRight': nextIdx = (idx + 1) % tabs.length; break;
        case 'ArrowLeft':  nextIdx = (idx - 1 + tabs.length) % tabs.length; break;
        case 'Home':       nextIdx = 0; break;
        case 'End':        nextIdx = tabs.length - 1; break;
        case 'Enter':
        case ' ':
          e.preventDefault();
          activateTab(wrap, current);
          return;
        default: return;
      }

      e.preventDefault();
      tabs[nextIdx].focus();
      activateTab(wrap, tabs[nextIdx]);
    });

  
    const hash = window.location.hash;
    if (hash) {
      const panel = wrap.querySelector(hash);
      if (panel) {
        const btn = tabs.find(t => t.dataset.target === hash);
        if (btn) return activateTab(wrap, btn);
      }
    }

    const initial = bar.querySelector('.stn-tab.is-active') || tabs[0];
    activateTab(wrap, initial);
  }

  document.querySelectorAll(SELECTORS.wrap).forEach(initBlock);
})();