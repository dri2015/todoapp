export const URL = 'login';

export default api => ({
    fetchEmployee: () => api.get(`/${URL}/`)
});
