let reg = false;

function toggle() {
  reg = !reg;
  const card    = document.getElementById('card');
  const left    = card.querySelector('.left');
  const title   = card.querySelector('.left-title');
  const sub     = card.querySelector('.left-sub');
  const btn     = card.querySelector('.left-btn');
  const rtitle  = card.querySelector('.login-title');

  if (reg) {
    left.style.left       = 'auto';
    left.style.right      = '0';
    left.style.borderRadius = '60% 0 0 60% / 50% 0 0 50%';
    card.querySelector('.right').style.paddingLeft  = '36px';
    card.querySelector('.right').style.paddingRight = '280px';
    title.textContent  = 'Welcome Back!';
    sub.textContent    = 'Already have an account?';
    btn.textContent    = 'Login';
    rtitle.textContent = 'Register';
  } else {
    left.style.left       = '0';
    left.style.right      = 'auto';
    left.style.borderRadius = '0 60% 60% 0 / 0 50% 50% 0';
    card.querySelector('.right').style.paddingLeft  = '280px';
    card.querySelector('.right').style.paddingRight = '36px';
    title.textContent  = 'Hello, Welcome!';
    sub.textContent    = "Don't have an account?";
    btn.textContent    = 'Register';
    rtitle.textContent = 'Login';
  }
}