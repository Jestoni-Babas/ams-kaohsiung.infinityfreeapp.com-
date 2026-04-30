async function loadGatherings() {

    const render = document.querySelector("#gathering_list_loader");

    try {

        const response = await fetch(`${BASE_URL}/api/attendance_gathering_types`);
        const data = await response.json();

        if(data.count === 0){
            render.innerHTML = `
                    <p>${data.message}</p>
                `;
            return;
        }

            let html = '';

            html += `
                    <select name="gathering_type" class="form-control" id="gathering_type" required>
                        <option value="">Select</option>
                `;
            data.data.forEach(gathering => {
                html += `
                            <option value="${gathering.gathering_name}">
                                ${gathering.gathering_name}
                            </option>
                    `;
            });
                

            html += `
                    </select>
                `;

            render.innerHTML = html;


    } catch(err) {
        console.error(err);
        render.innerHTML = `
            <p class="text-danger">Failed to load data!</p>
        `;
    }

}
loadGatherings();