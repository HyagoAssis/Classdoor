import axios from "axios";
function resource(path, actions = {}) {
    return Object.assign(
        {
            get: (id, params = {}, config = {}) =>
                axios.get(`${path}/${id}`, { params, ...config }),
            save: (obj, params = {}, config = {}) =>
                axios.post(path, obj, { params, ...config }),
            query: (params = {}, config = {}) => axios.get(path, { params, ...config }),
            update: (id, obj, params = {}, config = {}) =>
                axios.put(`${path}/${id}`, obj, { params, ...config }),
            delete: (id) => axios.delete(`${path}/${id}`),
        },
        actions
    );
}
export const classifiableItemService = resource('/api/classifiable_items');
