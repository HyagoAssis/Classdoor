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
export const classificationService = resource('/api/classifications', {
    useful: (id, params = {}) => axios.post(`/api/classifications/useful/${id}`,{ params }),
    downloadFile: (id, params = {}) => axios.get(`/api/classifications/download_file/${id}`,{ params })
});
export const complaintService = resource('/api/complaints', {
    changeStatus: (id, obj, params = {}) => axios.post(`/api/complaints/change_status/${id}`, obj, { params })
});
