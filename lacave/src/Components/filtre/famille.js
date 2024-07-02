import '/Users/code/Documents/La-Cave/lacave/src/Styles/Categories.css'

function Famille({setActiveFamille, famille,activeFamille}){
    return (
        <div className='lmj-categories'>
            <select 
                value={activeFamille}
                onChange={(e) => setActiveFamille(e.target.value)}
                className="lmj-categories-select"
                >
                    <option value=''>Vignoble</option>
                    {famille.map((cat)=>(
                        <option key={cat} value={cat}>{cat}</option>
                    ))}
                </select>
        </div>
    )
}

export default Famille