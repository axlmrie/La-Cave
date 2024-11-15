import '../../Styles/Categories.css'

function Annee({setActiveAnnee, annee,activeAnnee}){

    const sortedAnnee = [...annee].sort((a, b) => a - b);

    return (
        <div className='lmj-categories'>
            <select 
                value={activeAnnee}
                onChange={(e) => setActiveAnnee(e.target.value)}
                className="lmj-categories-select"
                >
                    <option value=''>Année</option>
                    {sortedAnnee.map((cat)=>(
                        <option key={cat} value={cat}>{cat}</option>
                    ))}
                </select>
        </div>
    )
}

export default Annee