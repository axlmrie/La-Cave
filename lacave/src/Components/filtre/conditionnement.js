import '/Users/maxencerebours/Documents/Projet-informatique/La-Cave/lacave/src/Styles/Categories.css'

function Conditionnement({setActiveConditionnement, conditionnement,activeConditionnement}){
    return (
        <div className='lmj-categories'>
            <select 
                value={activeConditionnement}
                onChange={(e) => setActiveConditionnement(e.target.value)}
                className="lmj-categories-select"
                >
                    <option value=''>Conditionnement</option>
                    {conditionnement.map((cat)=>(
                        <option key={cat} value={cat}>{cat}</option>
                    ))}
                </select>
        </div>
    )
}

export default Conditionnement