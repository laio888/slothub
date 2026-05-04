function showErr(id, show) { 
    const err = document.getElementById('err-' + id); 
    const input = document.getElementById(id); 
    if (err) err.classList.toggle('show', show); 
    if (input) input.classList.toggle('invalid', show); 
} 
function isEmpty(id) { 
    const el = document.getElementById(id); 
    return !el || el.value.trim() === ''; 
} 
function isValidEmail(id) { 
    const el = document.getElementById(id); 
    return el && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value.trim()); 
} 
function submitLogin() { 
    let ok = true;
    if (!isValidEmail('loginEmail')) { showErr('loginEmail', true); ok = false; } 
    else showErr('loginEmail', false); 
    if (isEmpty('loginPass')) { showErr('loginPass', true); ok = false; } 
    else showErr('loginPass', false); 
    if (ok) { 
        const banner = document.getElementById('loginSuccess'); banner.classList.add('show'); 
        setTimeout(() => banner.classList.remove('show'), 3000); 

    } 
}