(() => {
  const nav = ["首页","归档","友链","留言","关于","更多"]; 
  const quickNav = document.getElementById('quickNav');
  if (quickNav) {
    quickNav.innerHTML = nav.map(item => `
      <button class="lg-glass lg-nav-icon" aria-label="${item}">
        <span class="lg-nav-dot"></span><span>${item}</span>
      </button>
    `).join('');
  }

  document.addEventListener('click', (event) => {
    const target = event.target;
    if (!(target instanceof HTMLElement)) return;
    if (target.textContent?.includes('更多')) {
      document.getElementById('moreNavSheet')?.toggleAttribute('hidden');
    }
  });
})();
