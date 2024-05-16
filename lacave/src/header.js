import {Link} from 'react-router-dom'
import React from 'react';
const Header =()=> {
  return (
    <div className='header-complete'>
    <nav className="header">
      <h1>La Cave 🍷</h1>
      <ul>
        <li>
          <Link to="/">
            Accueil
          </Link>
        </li>
        <li>
          <Link to="/stock">Stock</Link>
        </li>
        <li>
          <Link to="/inventaire">Inventaire</Link>
        </li>
      </ul>
    </nav>
    </div>
    
  );
}

export default Header;