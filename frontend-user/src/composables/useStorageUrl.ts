export const useStorageUrl = () => {
  function getStorageUrl(path: string) {
    return `${import.meta.env.VITE_STORAGE_URL}${path}`;
  }

  return { getStorageUrl };
};
