import './App.css';
import React from "react";
import axios from "axios";

const App = () => {
  const [data, setData] = React.useState({
    posts: []
  });
  React.useEffect(() => {
    const fetchData = async () => {
      const result = await axios(
          'https://jsonplaceholder.typicode.com/todos',
      );
      setData({
        ...data,
        ['posts']: result.data
      });
    };
    fetchData();
  }, []);

  return (
      <ul>
        {data.posts.map(item => (
            <li key={item.id}>
              {item.title}
            </li>
        ))}
      </ul>
  );
}

export default App;
