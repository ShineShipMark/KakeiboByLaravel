export const fetchAPIMethods = () => {
  const fetchs = async <T, U>(url: string, methods: string, data: U) => {
    const jsonData = JSON.stringify(data);
    const response = await fetch(url, {
      method: methods,
      headers: {
        "Content-Type": "application/json",
      },
      body: jsonData,
    });
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    return response.json() as T;
  };

  const searchData = async <T, Y>(
    url: string,
    method: string,
    param: Y,
  ): Promise<T> => {
    const { fetchs } = fetchAPIMethods();
    try {
      const result = await fetchs<T, Y>(url, `${method}`, param);
      return result;
    } catch (error) {
      throw error;
    }
  };
  return { fetchs, searchData };
};
