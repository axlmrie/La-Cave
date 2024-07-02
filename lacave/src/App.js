import React from 'react';
import './App.css';
import Header from './header';
import Home from './home';
import Footer from './footer';


const App = ()=>{
  return (
    <div className='App'>
      <Header/>
      <Home/>
      <Footer/>
    </div>
  );
}

export default App;
