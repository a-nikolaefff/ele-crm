import autoComplete from "@tarekraafat/autocomplete.js/dist/autoComplete";

const projectOrganizationIdElement = document.getElementById('projectOrganizationId');
const projectOrganizationResetAutocompleteElement = document.getElementById('projectOrganizationResetAutocomplete');
const projectOrganizationSelectElement = document.getElementById('projectOrganizationSelect');

if (projectOrganizationIdElement.value !== "") {
    projectOrganizationResetAutocompleteElement.classList.add('resetAutocomplete__displayed')
}

const projectOrganizationAutocomplete = new autoComplete({

    selector: "#projectOrganizationAutocomplete",

    placeHolder: "Поиск по базе проектных организаций",

    data: {
        src: async (query) => {
            try {
                const response = await axios.get('/customers/autocomplete', {
                    params: {
                        search: query,
                        is_project_organization: true
                    }
                });
                const data = response.data;
                console.log(data);
                return data;
            } catch (error) {
                console.error(error);
                return [];
            }
        },

        // Object keys by which the search will be performed
        keys: ["name", "full_name"],

        // Filter duplicates in case of multiple data keys usage
        filter: (list) => {
            return Array.from(
                new Set(list.map((value) => value.match))
            ).map((food) => {
                return list.find((value) => value.match === food);
            });
        },
    },

    resultItem: {
        element: (item, data) => {
            // Modify Results Item Style
            item.style = "display: flex; justify-content: space-between;";
            // Modify Results Item Content
            item.innerHTML = `
      <span style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
        ${data.match}
      </span>
      <span style="display: flex; align-items: center; font-size: 13px; font-weight: 100; text-transform: uppercase; color: rgba(0,0,0,.2);">
         ${data.key === 'name' ? 'имя' : data.key === 'full_name' ? 'полное имя' : ''}
      </span>`;
        },
        highlight: false
    },

    resultsList: {
        element: (list, data) => {
            const info = document.createElement("p");
            if (data.results.length > 0) {
                info.innerHTML = `Показаны <strong>${data.results.length}</strong> результатов из <strong>${data.matches.length}</strong>`;
            } else {
                info.innerHTML = `Найдено <strong>${data.matches.length}</strong> подходящих результатов для <strong>"${data.query}"</strong>`;
            }
            list.prepend(info);
        },
        noResults: true,
        maxResults: 20,
        tabSelect: true
    },
    events: {
        input: {
            selection: (event) => {
                const selection = event.detail.selection.value;
                projectOrganizationAutocomplete.input.value = selection.name;
                projectOrganizationIdElement.value = selection.id;

                let emptyOption = projectOrganizationSelectElement.querySelector('option[value=""]');
                while (projectOrganizationSelectElement.firstChild) {
                    projectOrganizationSelectElement.removeChild(projectOrganizationSelectElement.firstChild);
                }
                projectOrganizationSelectElement.appendChild(emptyOption);

                const employees = selection.employees;
                employees.forEach((employee, index) => {
                    let optionElement = document.createElement('option');
                    optionElement.text = employee.name;
                    optionElement.value = employee.id;

                    if (index === 0) {
                        optionElement.selected = true;
                    }

                    projectOrganizationSelectElement.appendChild(optionElement);
                });

                projectOrganizationResetAutocompleteElement.classList.add('resetAutocomplete__displayed')
            }
        }
    }
});

projectOrganizationResetAutocompleteElement.addEventListener('click', () => {
    const selectionName = document.getElementById('projectOrganizationAutocomplete');
    selectionName.value = null;
    const selectionId = document.getElementById('projectOrganizationId');
    selectionId.value = null;

    projectOrganizationResetAutocompleteElement.classList.remove('resetAutocomplete__displayed');

    let emptyOption = projectOrganizationSelectElement.querySelector('option[value=""]');
    while (projectOrganizationSelectElement.firstChild) {
        projectOrganizationSelectElement.removeChild(projectOrganizationSelectElement.firstChild);
    }
    projectOrganizationSelectElement.appendChild(emptyOption);
});
